<?php

namespace ActivismeBe\Http\Controllers;

use ActivismeBe\Repositories\ActivityRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use ActivismeBe\Http\Requests\Backend\ActivitySearchValidator;

/**
 * LogsController 
 * 
 * De controller voor het weergeven van logs omtrent de gebeurtenissen in het systeem.
 * 
 * @author      Tim Joosten <Topairy@gmail.com>
 * @copyright   2017 Tim Joosten
 */
class LogsController extends Controller
{
    private $activityRepository; /** @var ActivityRepository $activityRepository */

    /**
     * LogsController constructor 
     * 
     * @param  ActivityRepository $activityRepository De abstractie laag tussen de controller en databank.
     * @return void
     */
    public function __construct(ActivityRepository $activityRepository)
    {
        $this->middleware(['role:admin', 'forbid-banned-user']);
        $this->activityRepository = $activityRepository;
    }

    /**
     * Controller voor de weergave van de activeits monitor. 
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('backend.logs.index', ['logs' => 
            $this->activityRepository->entity()->simplePaginate(20)
        ]);
    }

    /**
     * Zoek voor een specifieke activiteit in de logs. 
     * 
     * @param  ActivitySearchValidator $input De gegeven gebruikers invoer. 
     * @return \Illuminate\View\View
     */
    public function search(ActivitySearchValidator $input): View
    {
        return view('backend.logs.index', [
            'logs' => $this->activityRepository->searchLogs($input->term, 20)
        ]);
    }
}
