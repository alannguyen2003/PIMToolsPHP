<?php

namespace App\Repositories\Impl;

use App\Constant\AllTablesConstant;
use App\Models\ProjectEmployee;
use App\Repositories\IProjectEmployeeRepository;
use App\Utils\DateExtension;
use Exception;
use Illuminate\Support\Facades\DB;

class ProjectEmployeeRepository implements IProjectEmployeeRepository {
  public function findAll() {
    return ProjectEmployee::all();
  }

  public function findById($id) {
    throw new Exception("Not supported!");
  }

  public function create($data) {
    $index = DB::table(AllTablesConstant::PROJECT_EMPLOYEE_TABLE)->insert([
      "project_id" => $data->projectId,
      "employee_id" => $data->employeeId,
      "created_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate()),
      "updated_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate())
    ]);
    return $index;
  }

  public function update($data) {
    $entity = ProjectEmployee::
        where(['project_id', "=", $data->projectId],
              ["employee_id", "=", $data->employeeId])
      ->update([
        "employee_id" => $data->employeeId,
        "project_id" => $data->projectId,
        "updated_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate())
      ]);
    return $entity;
  }

  public function delete($data) {

  }

  public function getAllEmployeesOfProject($projectId) {
    return ProjectEmployee::where("project_id", "=", $projectId)->get();
  }

  public function getAllProjectsEmployeeHandles($employeeId){
    return ProjectEmployee::where("employee_id", "=", $employeeId)->get();
  }

  public function createMultipleRows($data) {
    $datas = [];
    foreach ($data->employees as $item) {
      if (DB::table(AllTablesConstant::PROJECT_EMPLOYEE_TABLE)
            ->where([
                ["project_id", "=", $data->projectId],
                ["employee_id", "=", (int) $item]
              ])->first() === null)
        array_push($datas, [
          "project_id" => $data->projectId,
          "employee_id" => (int) $item
        ]);
    }
    $records = DB::table(AllTablesConstant::PROJECT_EMPLOYEE_TABLE)
      ->insert($datas);
    return $records;
  }

  public function deleteMultipleRecords($data) {
    foreach ($data->employees as $item) {
      DB::table(AllTablesConstant::PROJECT_EMPLOYEE_TABLE)
      ->where([
        ["project_id", "=", $data->projectId],
        ["employee_id", "=", (int) $item]
      ])->delete();
    }
  }
}