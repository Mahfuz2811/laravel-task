<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('valid_url', function ($attribute, $value, $parameters, $validator) {
            $array = @get_headers($value);
            if (!$array) {
                return false;
            }
            $string = $array[0];
            return strpos($string,"200");
        });

        Paginator::useBootstrap();
    }
}
