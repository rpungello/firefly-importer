<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
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
        Http::macro('firefly', function () {
            return Http::baseUrl(config('services.firefly.base_uri').'/api')
                ->acceptJson()
                ->asJson()
                ->withToken(config('services.firefly.token'))
                ->withUserAgent('rpungello/firefly-importer')
                ->throw();
        });
    }
}
