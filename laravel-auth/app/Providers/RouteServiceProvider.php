<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        // load auth routes
        \Route::middleware('routes')
            ->namespace('Lumi\Auth\Domains')
            ->group(base_path('routes/lumi-auth.php'));

        //load routes
        \Route::middleware('routes')
            ->namespace('App\Domains')
            ->group(base_path('routes/routes.php'));
    }
}
