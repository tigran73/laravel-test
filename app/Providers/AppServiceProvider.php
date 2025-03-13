<?php

namespace App\Providers;

use App\Models\News;
use App\Models\Role;
use App\Models\User;
use App\Repositories\News\NewsRepository;
use App\Repositories\News\NewsRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
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
        $this->app->bind(UserRepositoryInterface::class, function($app){
            return new UserRepository(new User());
        });
        $this->app->bind(RoleRepositoryInterface::class, function($app){
            return new RoleRepository(new Role());
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
