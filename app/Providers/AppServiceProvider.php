<?php

namespace App\Providers;

use App\Providers\Config\RepositoryConfigureServices;
use App\Repositories\Impl\EmployeeRepository;
use App\Repositories\IEmployeeRepository;
use App\Services\IEmployeeService;
use App\Services\Impl\EmployeeService;
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
    }
}
