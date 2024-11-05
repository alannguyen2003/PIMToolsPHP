<?php 
namespace App\Repositories;

interface IGroupRepository extends IRepository {
  public function getGroupLeader($groupId);
}