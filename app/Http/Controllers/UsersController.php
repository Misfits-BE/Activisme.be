<?php

namespace ActivismeBe\Http\Controllers;

use Carbon\Carbon;
use ActivismeBe\Http\Requests\Backend\UserValidator;
use ActivismeBe\Notifications\NewUser;
use ActivismeBe\Repositories\RoleRepository;
use ActivismeBe\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * UsersController
 * 
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright 2017 Tim Joosten
 */
class UsersController extends Controller
{
    private $userRepository; /** @var UserRepository $userRepository */

    /**
     * UsersController constructor
     *
     * @param  UserRepository $userRepository Abstractie laag tussen controller en model. 
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware(['role:admin', 'forbid-banned-user'])->except('destroy');
        $this->userRepository = $userRepository;
    }

    /**
     * De index method voor de users backend.
     * 
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('backend.users.index', ['users' => $this->userRepository->entity()->simplePaginate(15)]);
    }

    /**
     * Creatie formulier in de applicatie om een gebruiker toe te voegen. 
     *
     * @param  RoleRepository $roleRepository Abstractie laag tussen controller en database.
     * @return \Illuminate\View\View
     */
    public function create(RoleRepository $roleRepository): View
    {
        return view('backend.users.create', ['roles' => $roleRepository->all()]);
    }

    /**
     * De opslag methode om een gebruiker op the slaan in het systeem.
     *
     * @param  UserValidator $input De gegeven gebruikers invoer. (Gevalideerd).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserValidator $input): RedirectResponse
    {
        $password = str_random(16);
        $input->merge(['password' => bcrypt($password)]);

        if ($user = $this->userRepository->create($input->all())) {
            $user->assignRole($input->role);
            $user->notify((new NewUser($user, $password))->delay(Carbon::now()->addMinute(1)));

            flash("Er is een login aangemaakt voor {$user->name}")->success();

            activity('acl-activities')->performedOn($user)->causedBy($input->user())
                ->log("Heeft een login aangemaakt voor {$user->name}");
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Verwijder een gebruiker uit het systeem.
     *
     * @param  int $user de unieke identifier in de opslag.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $user): RedirectResponse
    {
        $user = $this->userRepository->findOrFail($user);

        if ($user->delete()) {
            flash("{$user->name} is verwijderd uit het platform.")->success();

            if (auth()->user()->hasRole('admin')) {
                activity('acl-activities')->performedOn($user)->causedBy(auth()->user())
                    ->log("Heeft {$user->name} verwijderd uit het systeem.");
            }
        }

        return redirect()->route('admin.users.index');
    }
}
