<?php

namespace App\Services\Impl;

use App\DTOs\Request\Group\CreateGroupRequest;
use App\DTOs\Request\Group\UpdateGroupRequest;
use App\Repositories\IGroupRepository;
use App\Services\IGroupService;  

class GroupService implements IGroupService {
  private $groupRepository;
  public function __construct(IGroupRepository $groupRepository) {
    $this->groupRepository = $groupRepository;
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
    $this->groupRepository->delete($data);
  }

  public function getGroupLeader($groupId) {
    return $this->groupRepository->getGroupLeader($groupId);
  }

}