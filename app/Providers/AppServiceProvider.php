<?php

namespace App\Providers;

use App\Queries\GymQueryBuilder;
use App\Queries\TrainerQueryBuilder;
use App\Services\Contracts\Social;
use App\Services\SocialService;
use App\Services\UploadService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(TrainerQueryBuilder::class);
        $this->app->bind(GymQueryBuilder::class);
        $this->app->bind(UploadService::class);

        //Services
        $this->app->bind(Social::class, SocialService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
    }
}
