<?php

namespace ActivismeBe\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\View\View;
use ActivismeBe\Repositories\CalendarRepository;
use ActivismeBe\Http\Controllers\Controller;

/**
 * Class CalendarController
 *
 * @author    Tim Joosten <tim@activisme.be>
 * @copyright 2018 Tim Joosten
 * @package   ActivismeBe\Http\Controllers\Frontend
 */
class CalendarController extends Controller
{
    /**
     * @var CalendarRepository $calendarRepository
     */
    private $calendarRepository;

    /**
     * CalendarController constructor.
     *
     * @param  CalendarRepository $calendarRepository Abstractie laag tussen controller, logica; database.
     * @return void
     */
    public function __construct(CalendarRepository $calendarRepository) 
    {
        $this->calendarRepository = $calendarRepository;
    }

    /**
     * De index controller voor de front-end kalender.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('frontend.calendar.index', [
            'dates' => $this->calendarRepository->entity()->whereHas('events', $filter = function ($query) {
                $query->where('status', 'public');
            })->with(['events' => $filter])->orderBy('start_date', 'DESC')->simplePaginate(15)
        ]);
    }
}
