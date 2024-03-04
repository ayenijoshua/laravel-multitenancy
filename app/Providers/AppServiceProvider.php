<?php

namespace App\Providers;

use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\CompanyRepository;
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
        $this->app->when(UserController::class)
          ->needs(RepositoryInterface::class)
          ->give(function () {
              return (new UserRepository(new \App\Models\User));
          });

          $this->app->when(TenantController::class)
          ->needs(RepositoryInterface::class)
          ->give(function () {
              //return (new CompanyRepository(new \App\Models\Teneant));
          });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
