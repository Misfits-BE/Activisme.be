<?php

namespace ActivismeBe\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\View\View;
use ActivismeBe\Repositories\CalendarRepository;
use ActivismeBe\Http\Controllers\Controller;

class CalendarController extends Controller
{
    private $calendarRepository; 

    public function __construct(CalendarRepository $calendarRepository) 
    {
        $this->calendarRepository = $calendarRepository;
    }

    public function index(): View
    {
        return view('frontend.calendar.index', [
            'dates' => $this->calendarRepository->entity()->whereHas('events', $filter = function ($query) { 
                $query->where('status', 'public'); 
            })->with(['events' => $filter])->simplePaginate(15)
        ]);
    }
}
