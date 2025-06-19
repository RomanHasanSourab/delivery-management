<?php

namespace App\Providers;

use App\Services\DashboardCountsService;
use Facade\FlareClient\View;
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
//		$this->app->bind('path.public', function() {
//			return realpath(base_path().'/../public_html');
//        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Use the DashboardCountsService to get counts
        // This handles database connection errors gracefully
        $dashboardCounts = app(DashboardCountsService::class)->getCounts();

        // Share the counts with all views
        view()->share($dashboardCounts);
    }
}
