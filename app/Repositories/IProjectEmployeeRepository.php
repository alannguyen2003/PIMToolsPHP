<?php

namespace App\Repositories;

interface IProjectEmployeeRepository extends IRepository {
  public function getAllEmployeesOfProject($projectId);
  public function getAllProjectsEmployeeHandles($employeeId);
  public function createMultipleRows($data);
  public function deleteMultipleRecords($data);
}