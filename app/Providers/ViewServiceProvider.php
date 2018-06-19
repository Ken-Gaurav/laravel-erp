<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
       //$categories = \App\admin_menu::tree();

       //View::share('categories', $categories);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
