<?php

namespace App\Providers;

use App\Services\OrderEmailFilter\FilterChain;
use App\Services\OrderEmailFilter\IOrderEmailFilter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IOrderEmailFilter::class, FilterChain::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
