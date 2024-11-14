<?php

namespace App\Services\Impl;

use App\Constant\ApiResponseConstant;
use App\Constant\MessageConstant;
use App\Constant\OperationConstant;
use App\DTOs\ApiResponse;
use App\Repositories\IEmployeeRepository;
use App\Repositories\IGroupRepository;
use App\Repositories\IProjectEmployeeRepository;
use App\Repositories\IProjectRepository;
use App\Services\IProjectService;
use App\Utils\ResponseUtilities;
use Illuminate\Auth\Access\Response;

class ProjectService implements IProjectService {
  private $projectRepository;
  private $groupRepository;
  private $employeeRepository;
  private $projectEmployeeRepository;

  public function __construct(IProjectRepository $projectRepository,
                              IGroupRepository $groupRepository,
                              IEmployeeRepository $employeeRepository,
                              IProjectEmployeeRepository $projectEmployeeRepository) {
    $this->projectRepository = $projectRepository;
    $this->groupRepository = $groupRepository;
    $this->employeeRepository = $employeeRepository;
    $this->projectEmployeeRepository = $projectEmployeeRepository;
  }

  public function findAll() {
    $projects = $this->projectRepository->findAll();
    if ($projects->count() > 0) return ResponseUtilities::returnResponse(
      ApiResponseConstant::HTTP_OK,
      MessageConstant::GET_ALL,
      $projects
    );
    return ResponseUtilities::returnResponse(
      ApiResponseConstant::HTTP_NOT_FOUND,
      MessageConstant::NOT_FOUND,
      null
    );
  }

  public function findById($id) {
    $project = $this->projectRepository->findById($id);
    if ($project === null) return ResponseUtilities::returnResponse(
      ApiResponseConstant::HTTP_NOT_FOUND,
      MessageConstant::NOT_FOUND,
      null
    );
    return ResponseUtilities::returnResponse(
      ApiResponseConstant::HTTP_OK,
      MessageConstant::FIND_SUCCESS,
      $project
    );
  } 

  public function create($data) {
    $errors = $this->projectValidation($data, OperationConstant::CREATE);
    if (count($errors['customer']) > 0 ||
        count($errors['name']) > 0 ||
        count($errors['startDate, endDate']) > 0 ||
        count($errors['groupId']) > 0 ||
        count($errors['status']) > 0 ||
        count($errors['projectNumber']) > 0) return ResponseUtilities::returnResponse(
      ApiResponseConstant::HTTP_BAD_REQUEST,
      MessageConstant::BAD_REQUEST,
      $errors
    );
    return ResponseUtilities::returnResponse(
      ApiResponseConstant::HTTP_CREATED,
      MessageConstant::CREATED,
      $this->projectRepository->create($data)
    );
  }

  public function update($data) {
    $errors = $this->projectValidation($data, OperationConstant::UPDATE);
    if (count($errors["id"]) > 0 ||
        count($errors["name"]) > 0 ||
        count($errors["projectNumber"]) > 0 ||
        count($errors["groupId"]) > 0 ||
        count($errors["customer"]) > 0 ||
        count($errors["startDate, endDate"]) > 0 ||
        count($errors["status"]) > 0) return ResponseUtilities::returnResponse(
          ApiResponseConstant::HTTP_BAD_REQUEST,
          MessageConstant::BAD_REQUEST,
          $errors
        );
    return ResponseUtilities::returnResponse(
      ApiResponseConstant::HTTP_ACCEPTED,
      MessageConstant::UPDATED,
      $this->projectRepository->update($data)
    );
  }

  public function delete($data) {

  }

  public function getGroupHandle($id) {
    return ResponseUtilities::returnResponse(
      ApiResponseConstant::HTTP_OK,
      MessageConstant::FIND_SUCCESS,
      $this->projectRepository->getGroupHandle($id)
    );
  }

  public function projectValidation($data, $operation) {
    $statuses = ["NEW", "PLA", "INP", "FIN"];
    $errors = [
      "id" => [],
      "name" => [],
      "customer" => [],
      "status" => [],
      "projectNumber" => [],
      "groupId" => [],
      "startDate, endDate" => []
    ];
    //Property "ID"
    if (!$this->projectRepository->findById($data->id)) 
      array_push($errors["id"], "Project ID is not existed!!");
    //Property "name"
    if ($data->name === null) 
      array_push($errors["name"], "Project name is required!!");
    //Property "customer"
    if ($data->customer === null) 
      array_push($errors["customer"], "Customer of project is required!!");
    //Property "status"
    if ($data->status === null) 
      array_push($errors["status"], "Status is required!!");
    if (!in_array($data->status, $statuses))
      array_push($errors["status"], "Status must be one of statuses: NEW -> New, PLA -> Planned, INP -> In Progress, FIN -> Finished!!");
    //Property "projectNumber"
    if ($data->projectNumber === null) 
      array_push($errors["projectNumber"], "Project number is required!!");
    if ($data->projectNumber < 0 || $data->projectNumber > 9999) 
      array_push($errors['projectNumber'], "Project number need to be in range of 1 to 9999");
    if ($this->projectRepository->isExistProjectNumber($data->projectNumber) && 
        $operation === OperationConstant::CREATE) 
      array_push($errors["projectNumber"], "Project number is existed!!");
    if (!$this->projectRepository->isExistProjectNumber($data->projectNumber) && 
        $operation === OperationConstant::UPDATE) 
      array_push($errors["projectNumber"], "Project number is not existed!!");
    //Property "groupId"
    if ($data->groupId === null) 
      array_push($errors["groupId"], "Group ID is required!!");
    if ($this->groupRepository->findById($data->groupId) === null) 
      array_push($errors["groupId"], "Group ID is not existed!!");
    //Property "startDate" and "endDate"
    if ($data->startDate === null) 
      array_push($errors['startDate, endDate'], "Start date of project is required!!");
    if ($data->endDate !== null && $data->startDate >= $data->endDate) 
      array_push($errors["startDate, endDate"], "Start date must be later than end date and not the same date!!");
    return $errors;
  }

  public function addMultipleEmployeesToProject($data) {
    $errors = $this->addMultipleRowsValidation($data);
    if (count($errors["projectId"]) > 0 ||
        count($errors["employees"]) > 0)
          return ResponseUtilities::returnResponse(
            ApiResponseConstant::HTTP_BAD_REQUEST,
            MessageConstant::BAD_REQUEST,
            $errors
          );
    return ResponseUtilities::returnResponse(
      ApiResponseConstant::HTTP_CREATED,
      MessageConstant::CREATED,
      $this->projectEmployeeRepository->createMultipleRows($data)
    );
  }

  public function addMultipleRowsValidation($data) {
    $errors = [
      "projectId" => [],
      "employees" => []
    ];
    if (!$this->projectRepository->findById($data->projectId))
      array_push($errors["projectId"], "Project ID is not existed!!");
    foreach ($data->employees as $item) {
      if (!$this->employeeRepository->findById((int) $item)) 
        array_push($errors["employees"], "Employees no.".(int)$item." not existed!!");
    }
    return $errors;
  }

  public function getAllEmployeesOfProject($projectId) {
    $employees = $this->projectEmployeeRepository->getAllEmployeesOfProject($projectId);
    if (count($employees) > 0) {
      $list = [];
      foreach ($employees as $item) {
        array_push($list, $item->employee);
      }
      return ResponseUtilities::returnResponse(
        ApiResponseConstant::HTTP_OK,
        MessageConstant::FIND_SUCCESS,
        $list
      );
    }
    return ResponseUtilities::returnResponse(
      ApiResponseConstant::HTTP_NOT_FOUND,
      MessageConstant::NOT_FOUND,
      null
    );
  }

  public function getAllProjectsEmployeeHandles($employeeId) {
    $projects = $this->projectEmployeeRepository->getAllProjectsEmployeeHandles($employeeId);
    if (count($projects) > 0) {
      $list = [];
      foreach ($projects as $item) {
        array_push($list, $item->project);
      }
      return ResponseUtilities::returnResponse(
        ApiResponseConstant::HTTP_OK,
        MessageConstant::FIND_SUCCESS,
        $list
      );
    }
    return ResponseUtilities::returnResponse(
      ApiResponseConstant::HTTP_NOT_FOUND,
      MessageConstant::NOT_FOUND,
      null
    );
  }

  public function deleteMultipleEmployeesOfProject($data) {
    $this->projectEmployeeRepository->deleteMultipleRecords($data);
    return ResponseUtilities::returnResponse(
      ApiResponseConstant::HTTP_NO_CONTENT,
      MessageConstant::DELETED,
      null
    );
  }
}