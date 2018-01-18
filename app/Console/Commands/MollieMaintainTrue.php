<?php

namespace ActivismeBe\Console\Commands;

use Illuminate\Console\Command;

class MollieMaintainTrue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mollie:up';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Haal het molllie betalings systeem uit onderhoud.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
