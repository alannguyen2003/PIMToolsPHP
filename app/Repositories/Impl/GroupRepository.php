<?php 

namespace App\Repositories\Impl;

use App\Models\Group;
use App\Repositories\IGroupRepository;
use App\Utils\DateExtension;
use Illuminate\Support\Facades\DB;

class GroupRepository implements IGroupRepository {
  public function findAll() {
    return Group::all();
  }

  public function findById($id) { 
    return Group::find($id);
  }

  public function create($data) {
    $group = Group::create([
      "group_leader_id" => $data->getGroupLeaderId(),
      "created_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate()),
      "updated_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate()),
    ]);
    return $group;
  }

  public function update($data) {
    $groupEntity = Group::find($data->getId());
    if ($groupEntity !== null) {
      $group = DB::table("groups")->where('id', '=', $data->getId())
        ->update([
          'group_leader_id' => $data->getGroupLeaderId(),
          'updated_at' => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate())
        ]);
      
    }
    
    return $group;
  }

  public function delete($data) {

  }

  public function getGroupLeader($groupId) {
    return Group::find($groupId)->groupLeader;
  }
}