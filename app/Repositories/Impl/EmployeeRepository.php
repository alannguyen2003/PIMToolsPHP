<?php

namespace App\Repositories\Impl;

use App\Models\Employee;
use App\Models\Project;
use App\Repositories\IEmployeeRepository;
use Illuminate\Cache\Repository;
use App\DTOs\Request\Employee\CreateEmployeeRequest;
use App\Repositories\IRepository;
use App\Utils\Mappers\EmployeeMapper;
use App\Utils\DateExtension;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EmployeeRepository implements IEmployeeRepository {
  public function __construct() {
  }

  public function findAll() {
    return Employee::all();
  }

  public function findById($id) {
    return Employee::find($id);
  }

  public function getGroupOfEmployee($id) {
    return Employee::find($id)->group;
  }

  public function create($data) {
    // $employee = EmployeeMapper::mapFromCreateEmployeeRequest($request)
    $employee = Employee::create([
      "visa" => $data->getVisa(),
      "first_name" => $data->getFirstName(),
      "last_name" => $data->getLastName(),
      "birth_date" => $data->getBirthDate(),
      "created_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate()),
      "updated_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate()),
    ]);
    return $employee;
  }

  public function update($data) {
    // $employee = Employee::findOrFail($data->getId());
    // $employee->setFirstName($data->getFirstName());
    // $employee->setLastName($data->getLastName());
    // $employee->setBirthdate($data->getBirthDate());
    // $employee->save();

    $entity = DB::table("employees")->where('id', $data->getId())
      ->update([
        "visa" => $data->getVisa(),
        "first_name" => $data->getFirstName(),
        "last_name" => $data->getLastName(),
        "birth_date" => $data->getBirthDate(),
        "updated_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate())
      ]);
    return $entity;
  }

  public function delete($data) {
    $employee = Employee::findOrFail($data->getId());
    if ($employee !== null) {
      $employee->delete();
    }
  }
}
