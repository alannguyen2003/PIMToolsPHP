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
    if (count($errors) > 0) return ResponseUtilities::returnResponse(
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
    $errors = [];
    if ($this->groupRepository->findById($data->groupId) === null) 
      array_push($errors, "Group ID is not existed!!");
    if (!$this->projectRepository->isExistProjectNumber($data->projectNumber)) 
      array_push($errors, "Project number is existed!!");
    if ($data->startDate >= $data->endDate) 
      array_push($errors, "Start date must be later than end date and not the same date!!");
    if (!in_array($data->status, $statuses))
      array_push($errors, "Status must be one of statuses: NEW -> New, PLA -> Planned, INP -> In Progress, FIN -> Finished!!");
      return $errors;
  }
}