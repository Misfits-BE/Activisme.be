<?php

namespace ActivismeBe\Http\Controllers\Frontend;

use Mail;
use ActivismeBe\Mail\sendContactForm;
use ActivismeBe\Http\Requests\Frontend\ContactValidator;
use Illuminate\Http\Request;
use ActivismeBe\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

/**
 * [Frontend]: Contact Controller
 * 
 * @author      Tim Joosten <Topairy@gmail.com>
 * @copyright   2017 Tim Joosten
 */
class ContactController extends Controller
{
    /**
     * Zend de mail naar de verantwoordelijke in de vzw. 
     *
     * @param  ContactValidator $input De door ge gast gegeven invoer. (Gevalideerd)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(ContactValidator $input): RedirectResponse
    {
        Mail::to(config('platform.contact.email'))->send(new sendContactForm($input->all()));
        
        return back(302); // Herleid de gebruiker terug naar de vorige pagina. 
    }
}
