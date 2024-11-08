<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = "groups";
    protected $fillable = ["group_leader_id"];
    public function groupLeader() {
        return $this->belongsTo(Employee::class);
    }

    public function projects() {
        return $this->hasMany(Project::class);  
    }
}
