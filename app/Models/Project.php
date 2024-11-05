<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = "projects";
    protected $fillable = ["group_id", "project_number", "name", "customer", "status",
                            "start_date", "end_date"];

    public function projectsEmployees() {
        return $this->hasMany(ProjectEmployee::class, "project_id");
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }

}
