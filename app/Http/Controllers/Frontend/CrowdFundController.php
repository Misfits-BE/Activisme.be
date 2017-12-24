<?php

namespace ActivismeBe\Http\Controllers\Frontend;

use Share;
use ActivismeBe\Repositories\GiftRepository;
use Illuminate\Http\Request;
use ActivismeBe\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * [Frontend]: Crowdfund controller. 
 * 
 * @author      Tim Joosten <Topairy@gmail.com>
 * @copyright   2017 Tim Joosten
 */
class CrowdFundController extends Controller
{
    private $giftRepository; /** @var GiftRepository $giftRepository */

    /**
     * CrowdfundController constructor
     *
     * @param  GiftRepository   $giftRepository     Abstractie laag tussen, controller en ORM.
     * @return void
     */
    public function __construct(GiftRepository $giftRepository) 
    {
        $this->middleware(['mollie-maintain'])->except(['index']);
        $this->giftRepository = $giftRepository; 
    }

    /**
     * Geef de basis informatie view weer voor onze crowdfund. 
     * 
     * @todo Implementatie twitter tweet link
     * @todo Implementatie facebook share link.
     * 
     * @return \illuminate\View\View
     */
    public function index(): View
    {
        return view('frontend.ondersteuning', [
            'collected' => $this->giftRepository->entity()->where('status', 'paid')->sum('amount'), 
            'backers'   => $this->giftRepository->entity()->where('status', 'paid')->count(),
            'social'    => Share::load(route('ondersteuning.index'), 'Ondersteun Activisme_be')->services('facebook', 'twitter')
        ]);
    }

    /**
     * Het creatie formulier voor een nieuwe gift. 
     *
     * @param  string $plan De naam van het plan waarin de gebruiker geintresseerd is. 
     * @return \Illuminate\View\View
     */
    public function create($plan): View
    {
        return view('frontend.ondersteuning.create', [
            'plan'      => $this->giftRepository->prefillPlan($plan),
            'collected' => $this->giftRepository->entity()->where('status', 'paid')->sum('amount'), 
            'backers'   => $this->giftRepository->entity()->where('status', 'paid')->count(),
            'social'    => Share::load(route('ondersteuning.index'), 'Ondersteun Activisme_be')->services('facebook', 'twitter')
        ]);
    }

    /**
     * Het bedank bericht voor een gift.
     * 
     * @todo De uuid zou moeten vervangen worden in een latere fase door een experation url. 
     *       Misschien dat UrlSigner package van spatie ons hierbij kan helpen.
     * 
     * @param  $uuid De unieke waarde als controle voor het dankt bericht. 
     * @return \Illuminate\View\View
     */
    public function show($uuid): View
    {
        $this->giftRepository->entity()->where('uuid', $uuid)->firstOrFail();
        flash("Wij hebben je gift goed ontvangen. Bedankt voor het steunen van " . config('app.name') . ".")->success();
        
        return view('frontend.ondersteuning', [
            'collected' => $this->giftRepository->entity()->where('status', 'paid')->sum('amount'), 
            'backers'   => $this->giftRepository->entity()->where('status', 'paid')->count(),
            'social'    => Share::load(route('ondersteuning.index'), 'Ondersteun Activisme_be')->services('facebook', 'twitter')
        ]);         
    }
}
