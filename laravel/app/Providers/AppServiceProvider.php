<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\DATA;
use Jenssegers\Date\Date;

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

		if ($this->app->isLocal()) {
			$this->app->bind('path.public', function() {
				return base_path().'/../public';
			});
		}
		Schema::defaultstringLength(191);
		
		Date::setlocale(config(DATA::lang()));
		
		view()->composer('*', 'App\Http\Controllers\ArticlesController');
		view()->composer('*', 'App\Http\Controllers\DATA');
		
    }
}
