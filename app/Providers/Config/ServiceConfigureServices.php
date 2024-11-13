<?php 
namespace App\Providers\Config;

use App\Services\IEmployeeService;
use App\Services\IGroupService;
use App\Services\IHelperService;
use App\Services\Impl\EmployeeService;
use App\Services\Impl\GroupService;
use App\Services\Impl\HelperService;
use App\Services\Impl\ProjectService;
use App\Services\Impl\UserService;
use App\Services\IProjectService;
use App\Services\IUserService;
use Carbon\Laravel\ServiceProvider;

class ServiceConfigureServices extends ServiceProvider {
  public function boot() {
  }

  public function register() {
    $this->app->bind(IEmployeeService::class, EmployeeService::class);
    $this->app->bind(IGroupService::class, GroupService::class);
    $this->app->bind(IHelperService::class, HelperService ::class);
    $this->app->bind(IUserService::class, UserService::class);
    $this->app->bind(IProjectService::class, ProjectService::class);
  }
}