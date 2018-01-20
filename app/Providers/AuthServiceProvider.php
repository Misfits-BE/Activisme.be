<?php

namespace ActivismeBe\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \ActivismeBe\User::class        => \ActivismeBe\Policies\BanPolicy::class, 
        \ActivismeBe\NewsMailing::class => \ActivismeBe\Policies\NewsLetterPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
