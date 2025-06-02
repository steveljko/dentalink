<?php

namespace App\Providers;

use App\Support\Htmx;
use Illuminate\Support\ServiceProvider;

class HtmxServiceProvider extends ServiceProvider
{
    /**
     * Register HTMX service
     */
    public function register(): void
    {
        $this->app->singleton(Htmx::class);

        if (! function_exists('htmx')) {
            $this->app->bind('htmx', function ($app) {
                return $app->make(Htmx::class);
            });
        }
    }
}
