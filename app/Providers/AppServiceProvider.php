<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
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
        //
		Blade::if('tLike', function ($uId, $tId) {
			$judge = DB::table('t_like')->where('u_id', $uId)->where('t_id', $tId)->get();
			return $judge->isEmpty();
		});
		Blade::if('aLike', function ($uId, $aId) {
			$judge = DB::table('a_like')->where('u_id', $uId)->where('a_id', $aId)->get();
			return $judge->isEmpty();
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
