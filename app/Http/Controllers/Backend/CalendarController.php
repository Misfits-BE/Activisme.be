<?php

namespace ActivismeBe\Http\Controllers\Backend;

use Carbon\Carbon;
use ActivismeBe\Events;
use ActivismeBe\Http\Requests\Backend\CalendarValidator;
use ActivismeBe\Repositories\CalendarRepository;
use ActivismeBe\Repositories\EventsRepository;
use Illuminate\Http\Request;
use ActivismeBe\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * [Backend]: Kalender controller
 *
 * @author      Tim Joosten <Topairy@gmail.com>
 * @copyright   2017 Tim Joosten
 */
class CalendarController extends Controller
{
    private $calendarRepository; /** @var CalendarRepository $calendarRepository */
    private $eventRepository;    /** @var EventsRepository   $eventRepository    */

    /**
     * CalendarController constructor.
     *
     * @param  CalendarRepository $calendarRepository
     * @return void
     */
    public function __construct(CalendarRepository $calendarRepository, EventsRepository $eventRepository)
    {
        $this->middleware(['auth', 'role:admin', 'forbid-banned-user']);

        $this->eventRepository    = $eventRepository;
        $this->calendarRepository = $calendarRepository;
    }

    /**
     * Geef de beheers console weer voor kalender punten.
     *
     * @todo Schrijf phpunit test.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('backend.calendar.index', [
            'events' => $this->eventRepository->entity()->with(['dates'=> function ($query) {
                $query->orderBy('start_date', 'DESC');
            }])->simplePaginate(15),
        ]);
    }

    /**
     * Creatie weergave voor een evenement. 
     *
     * @todo Schrijf phpunit test
     * 
     * @return \Illuminate\View\View
     */
    public function create(): View 
    {
        return view('backend.calendar.create');
    }

    /**
     * Methode voor de opslag van het evenement in de databank. 
     *
     * @todo Opbouwen van de validator class. 
     * @todo Schrijven van een unit test.
     * @todo Implementatie activity logger.
     * 
     * @param  CalendarValidator $input De gegeven gebruikers invoer. (Gevalideerd)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CalendarValidator $input): RedirectResponse
    {
        $input->merge([
            'author_id'  => $input->user()->id,
            'start_time' => (new Carbon($input->start_time))->format('H:i'),
            'end_time'   => (new Carbon($input->end_time))->format('H:i'),
        ]);

        if ($date = $this->calendarRepository->entity()->firstOrCreate(['start_date' => $input->start_date])) {
            $event = $this->eventRepository->create($input->all());
            $date->events()->attach($event->id); // Event attachment to the date

            flash('Het evenement is opgeslagen in de databank.')->success();
        }

        return redirect()->route('admin.calendar.index');
    }

    /**
     * Formulier weergave voor het wijzigen van een evenement. 
     * 
     * @todo Implementeer phpunit test. 
     * @todo Opbouwen van de view. 
     * @todo opbouwen controller logic. 
     * @todo Implementatie activity logger. 
     * 
     * @param  int $event De database query voor het evenement. 
     * @return \Illuminate\View\View
     */
    public function edit(int $event): View
    {
        return view('backend.calendar.edit', [
            'event' => $this->eventRepository->with(['dates'])->findOrFail($event)
        ]); 
    }

    /**
     * Update een evenement in het systeem.
     *
     * @todo Uitschrijven van unit test 
     * 
     * @param  CalendarValidator $input     De gegeven gebruikers invoer. (Gevalideerd)
     * @param  int               $event     De controle query voor de database.   
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CalendarValidator $input, int $event): RedirectResponse
    {
        $event = $this->eventRepository->findOrFail($event);
        $date  = $this->calendarRepository->entity()->firstOrCreate(['start_date' => $input->start_date]);
        $input->merge([
            'start_time' => (new Carbon($input->start_time))->format('H:i'),
            'end_time'   => (new Carbon($input->end_time))->format('H:i'),
        ]);

        if ($event->update($input->all())) {
            $event->dates()->sync($date->id);

            $this->writeActivity('calendar', $event, 'Heeft een agenda puntje gewijzigd.');
            flash('U hebt het item in de kalender succesvol aangepast.')->success();
        }

        return redirect()->route('admin.calendar.index');
    }

    /**
     * Verander de status van het evenement in de kalender. 
     * 
     * @todo write phpunit test.
     * 
     * @param  string  $status  De nieuwe status voor het evenement.
     * @param  Events  $event   De collectie van het evenement in de databank. 
     * @return \Illuminate\Http\RedirectResponse 
     */
    public function status($event, $status): RedirectResponse
    {
        $event = $this->eventRepository->findOrFail($event); 

        if ($event->update(['status' => $status])) {
            flash("U hebt het evenement de status {$status} gegeven.")->success();
        }

        return redirect()->route('admin.calendar.index');
    }

    /** 
     * Verwijder een evenement uit de kalender. 
     * 
     * Geen detachering nodig van datums. Dit gebeurd automatisch in de databank. 
     * Doormiddel van foreign keys. 
     * 
     * @todo Schrijf phpunit test.
     * @todo Implement activity monitor
     * 
     * @param  Events $event Query om het evenement op the halen in de databanK. 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($event): RedirectResponse 
    {
        $event = $this->eventRepository->findOrFail($event);

        if ($event->delete()) {         //! Return true als waarde is verwijderd uit de databank.
            $event->dates()->delete();  //! [BUGGED]: Verwijder record op het sub model niveau.
            $event->dates()->detach();  //! Detacheer de 1 op meerdere relatie. 
            flash("Het evenement is verwijderd uit het systeem.")->success();
        }

        return redirect()->route('admin.calendar.index');
    }
}
