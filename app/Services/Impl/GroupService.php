<?php

namespace App\Services\Impl;

use App\Constant\ApiResponseConstant;
use App\Constant\MessageConstant;
use App\DTOs\ApiResponse;
use App\DTOs\Request\Group\CreateGroupRequest;
use App\DTOs\Request\Group\UpdateGroupRequest;
use App\Repositories\IGroupRepository;
use App\Repositories\IProjectRepository;
use App\Services\IGroupService;
use App\Utils\ResponseUtilities;

class GroupService implements IGroupService {
  private $groupRepository;
  private $projectRepository;
  public function __construct(IGroupRepository $groupRepository,
                              IProjectRepository $projectRepository) {
    $this->groupRepository = $groupRepository;
    $this->projectRepository = $projectRepository;
  }
  public function findAll(){
    return $this->groupRepository->findAll();
  }

  public function findById($id) {
    return $this->groupRepository->findById($id);
  }

  public function create($data) {
    return $this->groupRepository->create(new CreateGroupRequest(
      $data->groupLeaderId
    ));
  }

  public function update($data) {
    return $this->groupRepository->update($data);
  }

  public function delete($data) {
    $isHandleAnyProject = $this->groupRepository->isGroupHandleAnyProject($data);
    if ($isHandleAnyProject) return ResponseUtilities::returnResponse(
      ApiResponseConstant::HTTP_BAD_REQUEST,
      MessageConstant::BAD_REQUEST,
      "Some projects is handle by this group!! Cannot delete!!"
    );
    $group = $this->groupRepository->findById($data);
    if ($group === null) return ResponseUtilities::returnResponse(
      ApiResponseConstant::HTTP_NOT_FOUND,
      MessageConstant::NOT_FOUND,
      null
    );
    $this->groupRepository->delete($data);
    return ResponseUtilities::returnResponse(
      ApiResponseConstant::HTTP_NO_CONTENT,
      MessageConstant::DELETED,
      null
    );
  }

  public function getGroupLeader($groupId) {
    return $this->groupRepository->getGroupLeader($groupId);
  }

}