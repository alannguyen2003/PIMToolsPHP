<?php

namespace App\Services;

use App\Repositories\IRepository;

interface IProjectService extends IRepository {
  public function getGroupHandle($id);

  public function projectValidation($data, $operation);
  public function addMultipleEmployeesToProject($data);
  public function getAllEmployeesOfProject($projectId);
  public function getAllProjectsEmployeeHandles($employeeId);
  public function deleteMultipleEmployeesOfProject($data);
}