<?php

namespace App\Providers\Config;

use App\Repositories\IEmployeeRepository;
use App\Repositories\IGroupRepository;
use App\Repositories\Impl\EmployeeRepository;
use App\Repositories\Impl\GroupRepository;
use App\Repositories\Impl\ProjectEmployeeRepository;
use App\Repositories\Impl\ProjectRepository;
use App\Repositories\Impl\UserRepository;
use App\Repositories\IProjectEmployeeRepository;
use App\Repositories\IProjectRepository;
use App\Repositories\IUserRepository;
use Carbon\Laravel\ServiceProvider;

class RepositoryConfigureServices extends ServiceProvider {

  public function boot() {
  }
  public function register() {
    $this->app->bind(IEmployeeRepository::class, EmployeeRepository::class);
    $this->app->bind(IGroupRepository::class, GroupRepository::class);
    $this->app->bind(IUserRepository::class, UserRepository::class);
    $this->app->bind(IProjectRepository::class, ProjectRepository::class);
    $this->app->bind(IProjectEmployeeRepository::class, ProjectEmployeeRepository::class);
  }
}