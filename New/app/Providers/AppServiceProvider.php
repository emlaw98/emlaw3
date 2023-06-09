<?php

namespace App\Providers;
use Illuminate\Support\Facades\Auth;

use App\Models\Categories;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view) {
            $view->with('categoryProduct', Categories::Where('category_type', '0'));
        });
    }
}
