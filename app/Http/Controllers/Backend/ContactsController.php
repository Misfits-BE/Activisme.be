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
 * @todo implementatie activiteiten logger.
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
        $this->middleware(['role:admin', 'forbid-banned-user']);
        $this->contactRepository = $contactRepository;
    }

    /**
     * Index weergave voor de contacten console in de applicatie.
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
     * Creatie weergave voor een nieuw contact.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('backend.contacts.create');
    }

    /**
     * Weergave voor een contact persoon te wijzigen/
     *
     * @param  int $contact De databank entiteit van de contact persoon.
     * @return \Illuminate\View\View
     */
    public function edit(int $contact): View
    {
        $contact = $this->contactRepository->findOrFail($contact);
        return view('backend.contacts.edit', compact('contact'));
    }

    /**
     * Wijzig een contact persoon in de databank.
     *
     * @param  ContactsValidator $input   De gegeven gebruikers invoer. (Gevalideerd).
     * @param  int               $contact De databank entiteit van de contact persoon.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContactsValidator $input, int $contact): RedirectResponse
    {
        $contact = $this->contactRepository->findOrFail($contact);

        if ($contact->update($input->except('_token'))) {
            flash("{$contact->naam} is aangepast in het systeem.")->success(); 
        }

        return redirect()->route('admin.contacts.index');
    }

    /**
     * Methode voor het opslaan de de persoon in de databank.
     *
     * @param  ContactsValidator $input De gegegeven gebruikers invoer (Gevalideerd)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactsValidator $input): RedirectResponse
    {
        if ($contact = $this->contactRepository->create($input->except('_token'))) {
            flash(trans('contacts.flash-create', ['name' => $contact->naam]))->success();
        }

        return redirect()->route('admin.contacts.index');
    }

    /**
     * Methode voor het verwijderen van een contact persoon uit het systeem.
     *
     * @param  int $contact De databank entiteit voor de contacten.
     *
     * @throws \Exception
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $contact): RedirectResponse
    {
        $contact = $this->contactRepository->findOrFail($contact);

        if ($contact->delete()) {
            flash(trans('contacts.flash-delete', ['name' => $contact->naam]))->success();
        }

        return redirect()->route('admin.contacts.index');
    }
}
