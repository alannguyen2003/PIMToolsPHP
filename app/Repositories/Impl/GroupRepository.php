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
    $groupEntity = Group::find($data->id);
    if ($groupEntity !== null) {
      $group = DB::table("groups")->where('id', '=', $data->id)
        ->update([
          'group_leader_id' => $data->groupLeaderId,
          'updated_at' => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate())
        ]);
      
    }
    
    return $group;
  }

  public function delete($data) {
      $group = Group::findOrFail($data);
      if ($group !== null) {
        $group->delete();
      }
  }

  public function getGroupLeader($groupId) {
    $group = Group::findOrFail($groupId)->groupLeader;
    if ($group !== null) {
      return $group;
    }
    return null;
  }
}