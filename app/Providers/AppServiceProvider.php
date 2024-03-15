<?php

namespace App\Providers;

use App\Repositories\ISiteAddressRepository;
use App\Repositories\ISiteRepository;
use App\Repositories\SiteAddressRepository;
use App\Repositories\SiteRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            abstract: ISiteRepository::class,
            concrete: SiteRepository::class
        );

        $this->app->bind(
            abstract: ISiteAddressRepository::class,
            concrete: SiteAddressRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
