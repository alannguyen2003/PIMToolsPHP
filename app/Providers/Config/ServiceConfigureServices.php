<?php 
namespace App\Providers\Config;

use App\Services\IEmployeeService;
use App\Services\IGroupService;
use App\Services\Impl\EmployeeService;
use App\Services\Impl\GroupService;
use Carbon\Laravel\ServiceProvider;

class ServiceConfigureServices extends ServiceProvider {
  public function boot() {
  }

  public function register() {
    $this->app->bind(IEmployeeService::class, EmployeeService::class);
    $this->app->bind(IGroupService::class, GroupService::class);
  }
}