<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
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
        $this->app->bind(
            'App\Repositories\ProjectRepositoryInterface',
            'App\Repositories\ProjectRepository'
        );
        $this->app->bind(
            'App\Repositories\LabourRepositoryInterface',
            'App\Repositories\LabourRepository'
        );
        $this->app->bind(
            'App\Repositories\AttendenceRepositoryInterface',
            'App\Repositories\AttendenceRepository'
        );

        $this->app->bind(
            'App\Repositories\ManpowerReportRepositoryInterface',
            'App\Repositories\ManpowerReportRepository'
        );

        $this->app->bind(
            'App\Repositories\VendorRepositoryInterface',
            'App\Repositories\VendorRepository'
        );

        $this->app->bind(
            'App\Repositories\ItemRepositoryInterface',
            'App\Repositories\ItemRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        date_default_timezone_set("Asia/Dhaka");
    }
}
