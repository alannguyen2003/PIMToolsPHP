<?php 
namespace App\Repositories;

interface IGroupRepository extends IRepository {
  public function getGroupLeader($groupId);
  public function isGroupHandleAnyProject($id);
}