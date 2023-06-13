<?php

namespace App\Providers;

use App\Repositories\Contracts\IAddressRepository;
use App\Repositories\Contracts\IBaseRepository;
use App\Repositories\Contracts\IPatientRepository;
use App\Repositories\Core\AddressRepository;
use App\Repositories\Core\BaseRepository;
use App\Repositories\Core\PatientRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            IBaseRepository::class,
            BaseRepository::class
        );

        $this->app->bind(
            IPatientRepository::class,
            PatientRepository::class
        );

        $this->app->bind(
            IAddressRepository::class,
            AddressRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
