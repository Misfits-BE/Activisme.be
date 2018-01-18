<?php

namespace ActivismeBe\Console\Commands;

use ActivismeBe\Repositories\GiftRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mollie\Laravel\Facades\Mollie;
use Mollie_API_Exception;

/**
 * [Command]: Check voor de transactie status. 
 * 
 * Aangezien de payments bij creatie in ons platform de status 'open' krijgen 
 * moet er na de handling nog gecheckt worden op 1 of ander manier of deze zijn 
 * doorgevoerd. Vandaar die commando dat zowel invidueel als door een commando 
 * kan uitgevoerd worden.
 * 
 * @author      Tim Joosten <Topairy@gmail.com>
 * @copyright   2017 Tim Joosten
 */
class CheckGiftsCommand extends Command
{
    /**
     * De abstractie laag tussen command, logica en ORM. 
     * 
     * @var GiftRepository $giftRepository
     */
    private $giftRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mollie:check-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize the gift on mollie wioth our database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GiftRepository $giftRepository)
    {
        parent::__construct();
        $this->giftRepository = $giftRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $gifts = $this->giftRepository->findAllBy('processed', 'N', ['id', 'transaction_id']);

        foreach ($gifts as $gift) { // Loop door de giften in ons eigen betalings systeem.
            $payment = Mollie::api()->payments()->get($gift->transaction_id);
            
            if ($payment) { // Probeer de transactie te vinden in de payment gateway van Mollie.
                $this->giftRepository->find($gift->id)->update(['status' => $payment->status, 'processed' => 'Y']);
                $this->info("[SUCCESS]: Betaling {$payment->id} verwerkt.");
            }
            
            else {  // Geen transactie gevonden. Dus rapporteer de fout melding in de log.
                $this->info("[WARNING]: Kon een betaling niet verwerken.");
                Log::warning('Het commando ken een payment niet vinden in het systeem van mollie.');
            }
        }
    }
}
