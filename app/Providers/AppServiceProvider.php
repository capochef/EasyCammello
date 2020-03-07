<?php

namespace App\Providers;

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
    	if ($this->app->environment() === 'dev') { // or local or whatever
    		$this->app->register(\Potsky\LaravelLocalizationHelpers\LaravelLocalizationHelpersServiceProvider::class);
    	}
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
