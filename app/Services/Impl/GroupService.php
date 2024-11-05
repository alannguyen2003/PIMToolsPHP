<?php

namespace App\Services\Impl;

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

  }

  public function update($data) {

  }

  public function delete($data) {

  }

  public function getGroupLeader($groupId) {

  }
  
}