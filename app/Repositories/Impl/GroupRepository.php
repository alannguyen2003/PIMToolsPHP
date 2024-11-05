<?php 

namespace App\Repositories\Impl;

use App\Models\Group;
use App\Repositories\IGroupRepository;

class GroupRepository implements IGroupRepository {
  public function findAll() {
    return Group::all();
  }

  public function findById($id) { 
    return Group::find($id);
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