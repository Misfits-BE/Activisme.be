<?php

namespace ActivismeBe\Http\Controllers\Backend;

use ActivismeBe\Contact;
use ActivismeBe\Http\Requests\Backend\ContactsValidator;
use ActivismeBe\Repositories\ContactRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use ActivismeBe\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class ContactsController
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     ActivismeBe\Http\Controllers\Backend
 */
class ContactsController extends Controller
{
    /**
     * @var ContactRepository $contactRepository
     */
    private $contactRepository;

    /**
     * ContactsController constructor.
     *
     * @param  ContactRepository $contactRepository abstractie laag tussen logica, database, controller.
     * @return void
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->middleware(['role:admin']);
        $this->contactRepository = $contactRepository;
    }

    /**
     * Index weergave voor de contacten console in de applicatie.
     *
     * @todo Uitwerken phpunit test (Success, geen rechten, niet aangemeld)
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('backend.contacts.index', [
            'contacts' => $this->contactRepository->listContacts('simple', 15),
        ]);
    }

    /**
     * Creatie weergave voor een nieuw contact
     *
     * @todo Uitwerken phpunit test (Success, geen rechten, niet aangemeld)
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('backend.contacts.create');
    }

    /**
     * Methode voor het opslaan de de persoon in de databank.
     *
     * @todo Uitwerken phpunit test (success, validatie errors, niet aangemeld, geen rechten)
     *
     * @param  ContactsValidator $input De gegegeven gebruikers invoer (Gevalideerd)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactsValidator $input): RedirectResponse
    {
        //
    }

    /**
     * Methode voor het verwijderen van een contact persoon uit het systeem.
     *
     * @todo Uitwerken phpunit test (invalid id, success, geen rechten, niet aangemeld)
     *
     * @param  Contact $contact De databank entiteit voor de contacten.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        return redirect()->back(/** TODO: registratie index url */);
    }
}
