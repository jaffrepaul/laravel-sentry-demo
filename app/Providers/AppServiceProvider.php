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
        // Configure Sentry scope with custom context
        \Sentry\configureScope(function (Scope $scope): void {
            $scope->setContext('character', [
                'name' => 'Mighty Fighter',
                'age' => 19,
                'attack_type' => 'melee'
            ]);
        });
    }
}
