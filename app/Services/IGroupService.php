<?php 
namespace App\Services;

interface IGroupService extends IService {
  public function getGroupLeader($groupId);
}