<?php

namespace App\Providers;
use View;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         view()->composer('*',function($view) {
            //$view->with('user', Auth::user());
            $view->with('categories', \App\admin_menu::tree());
        });
       // $categories = \App\admin_menu::tree();

       // View::share('categories', $categories);
	   
	   
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
