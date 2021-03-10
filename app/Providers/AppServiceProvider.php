<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        //
        View::composer('*', function ($view) {
          $url = \Route::current()->uri;
          $page_array = explode("/", $url);
          $page = $page_array[0];
          $view->with('page', $page);
        });+

        Schema::defaultStringLength(191);
    }

    public function register()
    {
        //
    }
}
