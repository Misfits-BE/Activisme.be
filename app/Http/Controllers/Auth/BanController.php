<?php

namespace ActivismeBe\Http\Controllers\Auth;

use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use ActivismeBe\Http\Controllers\Controller;
use ActivismeBe\Repositories\UserRepository;

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
     * @param  int $user De unieke waarde van de gebruiker in de databank. 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(int $user): RedirectResponse
    {
        $user = $this->userRepository->getUser($user);

        // GATE:  De gebruiker heeft niet dezelfde id dan de aangemelde gebruiker. 
        // $user: De user is niet geblokkeerd in het systeem.
        if (Gate::allows('auth-user', $user) && $user->isNotBanned()) {
            $this->userRepository->lockUser($user->id);
            $this->writeActivity('acl-activities', $user, "Heeft {$user->name} geblokkeer in het systeem.");

            flash("{$user->name} is geblokkeerd in het systeem.")->success()->important();
        } else { // De gegeven gebruiker is dezelfde gebruiker als de aangemelde gebruiker. of deze is al geblokkeerd. 
            flash("Er iets misgelopen tijdens het blokkeren van de gebruiker.")->danger()->important();
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
        $user = $this->userRepository->getUser($user); 

        // GATE:  De gebruiker heeft niet dezelfde id dan de aangemelder gebruiker. 
        // $user: De user is geblokkeerd in het systeem.
        if (Gate::allows('auth-user', $user) && $user->isBanned()) {
            $this->userRepository->activateUser($user->id);
            $this->writeActivity('acl-activities', $user, "Heeft {$user->name} terug geactiveerd in het systeem."); 

            flash("{$user->name} is terug geactiveerd in het systeem.")->success()->important();
        } else { // De gegeven gebruiker is dezelfde gebruiker als de aangemelde gebruiker. Of deze is al actief. 
            flash("Er is iets misgelopen tijdens het activeren van de gebruiker")->error()->important();
        }

        return redirect()->route('admin.users.index');
    }
}
