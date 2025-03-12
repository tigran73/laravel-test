<?php

namespace App\Providers;

use App\Models\News;
use App\Repositories\News\NewsRepository;
use App\Repositories\News\NewsRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NewsRepositoryInterface::class, function($app){
            return new NewsRepository(new News());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
