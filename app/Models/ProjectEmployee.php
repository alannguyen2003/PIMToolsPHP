<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectEmployee extends Model
{
    protected $table = "projects_employees";
    protected $fillable = ["project_id", "employee_id"];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
