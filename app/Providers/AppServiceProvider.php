<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\YahooFinanceService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(YahooFinanceService::class, function() {
            return new YahooFinanceService(env('RAPID_API_KEY'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
