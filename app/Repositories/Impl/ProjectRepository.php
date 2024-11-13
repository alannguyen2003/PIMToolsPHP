<?php

namespace App\Repositories\Impl;

use App\Constant\AllTablesConstant;
use App\Models\Project;
use App\Repositories\IProjectRepository;
use App\Utils\DateExtension;
use Illuminate\Support\Facades\DB;

class ProjectRepository implements IProjectRepository {
  public function findAll() {
    return Project::all();
  }

  public function findById($id) {
    return Project::findOrFail($id);
  }

  public function create($data) {
    $project = Project::create([
      "group_id" => $data->groupId,
      "project_number" => $data->projectNumber,
      "name" => $data->name,
      "customer" => $data->customer,
      "status" => $data->status,
      "start_date" => $data->startDate,
      "end_date" => $data->endDate,
      "created_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate()),
      "updated_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate())
    ]);
    return $project;
  }

  public function delete($data) {
    $project = Project::findOrFail($data->id);
    if ($project !== null) {
      $project->delete();
    }
  }

  public function update($data) {
    $entity = DB::table(AllTablesConstant::PROJECT_TABLE)->where('id', $data->id)
      ->update([
        "group_id" => $data->groupId,
        "project_number" => $data->projectNumber,
        "name" => $data->name,
        "customer" => $data->customer,
        "status" => $data->status,
        "start_date" => $data->startDate,
        "end_date" => $data->endDate,
        "updated_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate())
      ]);
    return $entity;
  }

  public function getGroupHandle($id) {
    return Project::find($id)->group;
  }

  public function isExistProjectNumber($projectNumber) {
    return Project::where("project_number", "=", $projectNumber)->first() !== null? true : false;
  }
}