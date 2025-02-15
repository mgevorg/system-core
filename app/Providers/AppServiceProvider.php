<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

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
        // Passport::routes();
        // Passport::hashClientSecrets();
        // Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
    }
}
// Client ID ................................................................................................... 9d53250a-e77d-48db-92f2-897afb690413  
// Client secret ........................................................................................... igfPwall137djW6vklT8FAjTWE9MHR28fUZt6hGn  