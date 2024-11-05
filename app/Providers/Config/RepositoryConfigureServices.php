<?php

namespace App\Providers\Config;

use App\Repositories\IEmployeeRepository;
use App\Repositories\IGroupRepository;
use App\Repositories\Impl\EmployeeRepository;
use App\Repositories\Impl\GroupRepository;
use Carbon\Laravel\ServiceProvider;

class RepositoryConfigureServices extends ServiceProvider {

  public function boot() {
  }
  public function register() {
    $this->app->bind(IEmployeeRepository::class, EmployeeRepository::class);
    $this->app->bind(IGroupRepository::class, GroupRepository::class);
  }
}