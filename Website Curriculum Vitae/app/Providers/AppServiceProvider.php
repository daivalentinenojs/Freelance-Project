<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Validator;
use Illuminate\Support\Facades\Hash;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      if (config('app.https') == 'true') {
        URL::forceScheme('https');
      }

      Validator::extend('password_hash', function($attribute, $value, $parameters)
      {
        if ($value=="")
        {
          return true;
        }
        if(!Hash::check($value,$parameters[0]))
        {
          return false;
        }
        return true;
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
