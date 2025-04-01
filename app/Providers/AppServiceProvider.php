<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Sentry\State\Scope;

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
        // Configure Sentry scope with custom context and tags
        \Sentry\configureScope(function (Scope $scope): void {
            // Set custom context
            $scope->setContext('character', [
                'name' => 'Mighty Fighter',
                'age' => 19,
                'attack_type' => 'melee'
            ]);

            // Set custom tags
            $scope->setTag('page.locale', 'en-us');
            $scope->setTag('app.environment', config('app.env'));
            $scope->setTag('app.debug', config('app.debug') ? 'true' : 'false');
        });
    }
}
