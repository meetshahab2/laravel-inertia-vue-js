<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Admin\AdminRepositoryInterface;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\PatientRepositoryInterface;
use App\Repositories\Admin\PatientRepository;
use App\Repositories\Admin\DepartmentRepositoryInterface;
use App\Repositories\Admin\DepartmentRepository;
use App\Repositories\Admin\SpecializationRepositoryInterface;
use App\Repositories\Admin\SpecializationRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       $this->app->bind(
        \App\Repositories\Admin\AdminRepository::class,
        \App\Repositories\Admin\AdminRepository::class
      );

      $this->app->bind(
        PatientRepositoryInterface::class,
        PatientRepository::class
      );

      $this->app->bind(
        DepartmentRepositoryInterface::class,
        DepartmentRepository::class
      );

      
      $this->app->bind(
          SpecializationRepositoryInterface::class,
          SpecializationRepository::class
      );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
