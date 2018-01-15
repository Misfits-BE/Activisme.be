<?php

namespace ActivismeBe\Http\Controllers\Auth;

use Illuminate\Http\Request;
use ActivismeBe\Http\Requests\Auth\InfoValidator; 
use ActivismeBe\Http\Requests\Auth\SecurityValidator;
use ActivismeBe\Repositories\UserRepository;
use ActivismeBe\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse; 
use Illuminate\View\View;

/**
 * [Authencation]: Account configuratie controller. 
 * 
 * De controller voor het aanpassen van account gegevens. 
 * 
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright 2017 Tim Joosten
 */
class AccountSettingsController extends Controller
{
    private $userRepository; 

    public function __construct(UserRepository $userRepository) 
    {
        $this->middleware(['forbid-banned-user', 'auth']); 
        $this->userRepository = $userRepository;
    }

    /**
     * Index pagina voor de account configuratie. 
     *
     * @return \Illuminate\View\View
     */
    public function index(): View 
    {
        $user = $this->userRepository->findOrFail(auth()->user()->id);
        return view('auth.account-settings', compact('user'));
    }

    /**
     * Pas de account informatie aan in de databank. 
     *
     * @param  InfoValidator $input De invoer van het formulier. (Gevalideerd). 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInformation(InfoValidator $input): RedirectResponse 
    {
        $user = $this->userRepository->findOrfail(auth()->user()->id);

        if ($user->update($input->all())) {
            flash('U hebt uw account informatie succesvol aangepast.')->success();
        } 

        return redirect()->route('account.settings', ['type' => 'informatie']);
    }

    /**
     * Pas de account beveiliging aan in de databank. 
     * 
     * @param  SecurityValidator $input De invoer van het formulier. (Gevalideerd). 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSecurity(SecurityValidator $input): RedirectResponse 
    {
        $user = $this->userrepository->findOrFail(auth()->user()->id); 

        if ($user->update($input->all())) {
            flash('U hebt uw account beveiliging succesvol aangepast.')->success();
        } 

        return redirect()->route('account.settings', ['type' => 'beveiliging']);
    }
}
