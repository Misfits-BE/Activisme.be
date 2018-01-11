<?php

namespace ActivismeBe\Http\Controllers\Auth;

use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use ActivismeBe\Http\Controllers\Controller;
use ActivismeBe\Repositories\UserRepository;
use ActivismeBe\Traits\ActivityLog;

/**
 * BanController 
 * 
 * De controller voor het activeren en blokkeren van logins in het systeem. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten 
 */
class BanController extends Controller
{
    use ActivityLog;

    /**
     * @var UserRepository $userRepository
     */
    private $userRepository; 

    /**
     * BanController constructor 
     * 
     * @param  UserRepository $userRepository Abstractie laag tussen logica, model en controller. 
     * @return void
     */
    public function __construct(UserRepository $userRepository) 
    {
        $this->middleware(['role:admin']); 
        $this->userRepository = $userRepository;
    }

    /**
     * Blokkeer een gebruiker in het systeem. 
     * 
     * @todo Implementatie activiteiten logger. 
     * 
     * @param  int $user De unieke waarde van de gebruiker in de databank. 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(int $user): RedirectResponse
    {
        $user = $this->userRepository->getUser($user);

        if (Gate::allows('auth-user', $user)) {
            // De gegeven gebruiker is niet dezelfde dan de aangemelde gebruiker. 
            $this->userRepository->lockUser($user->id);
            $this->writeActivity('acl-activities', $user, "Heeft {$user->name} geblokkeer in het systeem.");

            flash("{$user->name} is geblokkeerd in het systeem.")->success();
        } else {
            // De gegeven gebruiker is dezelfde gebruiker als de aangemelde gebruiker.
            flash("Helaas jij kan jezelf niet blokkeren in het systeem.")->danger();
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Verwijder een blokkering van een gebruiker. 
     * 
     * @todo routering 
     * @todo activiteiten logger
     * 
     * @param  int $user De unieke waarde van de gebruiker in de databank.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $user): RedirectResponse
    {
        // 
    }
}
