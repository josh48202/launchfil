<?php

namespace App\Providers;

use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\Azure\Provider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // breezy fix to allow for 2fa without password for users using only SSO
//        session(['auth.password_confirmed_at' => time()]);

        Event::listen(function (SocialiteWasCalled $event) {
            $event->extendSocialite('azure', Provider::class);
        });
    }
}
