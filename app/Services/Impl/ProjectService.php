<?php

namespace App\Services\Impl;

use App\Constant\ApiResponseConstant;
use App\Constant\MessageConstant;
use App\DTOs\ApiResponse;
use App\Repositories\IGroupRepository;
use App\Repositories\IProjectRepository;
use App\Services\IProjectService;
use App\Utils\ResponseUtilities;
use Illuminate\Auth\Access\Response;

class ProjectService implements IProjectService {
  private $projectRepository;
  private $groupRepository;

  public function __construct(IProjectRepository $projectRepository,
                              IGroupRepository $groupRepository) {
    $this->projectRepository = $projectRepository;
    $this->groupRepository = $groupRepository;
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
    $errors = $this->projectValidation($data);
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

  }

  public function delete($data) {

  }

  public function getGroupHandle($id) {
    
  }

  public function projectValidation($data) {
    $statuses = ["NEW", "PLA", "INP", "FIN"];
    $errors = [
      "name" => [],
      "customer" => [],
      "status" => [],
      "projectNumber" => [],
      "groupId" => [],
      "startDate, endDate" => []
    ];
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
    if ($this->projectRepository->isExistProjectNumber($data->projectNumber)) 
      array_push($errors["projectNumber"], "Project number is existed!!");
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
}