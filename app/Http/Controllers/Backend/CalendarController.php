<?php

namespace ActivismeBe\Http\Controllers\Backend;

use Carbon\Carbon;
use ActivismeBe\Calendar;
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
        $this->middleware(['role:admin']);

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
            'events' => $this->eventRepository->entity()->with(['dates'])->simplePaginate(15),
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

        if ($date = $this->calendarRepository->create($input->all())) {
            $event = $this->eventRepository->create($input->all());
            $date->events()->attach($event->id); // Event attachment to the date

            flash('Het evenement is opgeslagen in de databank.')->success();
        }

        return redirect()->route('admin.calendar.index');
    }

    /**
     * Formulier weergave voor het wijzigen van een evenement. 
     * 
     * @todo Implementeer routering 
     * @todo Implementeer phpunit test. 
     * @todo Opbouwen van de view. 
     * @todo Implementatie activity logger. 
     * 
     * @param  Calendar $calender De database query voor het evenement. 
     * @return \Illuminate\View\View
     */
    public function edit(Calendar $calendar): View
    {
        // TODO: Implementatie controller Logica
    }

    /**
     * Update een evenement in het systeem.
     *
     * @todo Uitschrijven van unit test 
     * @todo Implementatie activity logger.
     * 
     * @param  CalendarValidator $input     De gegeven gebruikers invoer. (Gevalideerd)
     * @param  Calendar          $calendar  
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CalendarValidator $input, Calendar $calendar): RedirectResponse
    {
        if ($this->calendarRepository->update($input->all(), $calendar->id)) {
            flash('U hebt het item in de kalender succesvol aangepast.')->success();
        }

        return redirect()->route('admin.calendar.create');
    }
}
