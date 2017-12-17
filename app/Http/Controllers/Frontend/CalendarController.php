<?php

namespace ActivismeBe\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use ActivismeBe\Repositories\CalendarRepository;
use ActivismeBe\Http\Controllers\Controller;

class CalendarController extends Controller
{
    private $calendarRepository; 

    public function __construct(CalendarRepository $calendarRepository) 
    {
        $this->calpendarRepository = $calendarRepository;
    }

    public function index() 
    {
        $baseModel = $this->calendarRepository->entity();

        return view('frontend.calendar.index', [
            'events' => $baseModel->simplePaginate(15)
        ]);
    }
}
