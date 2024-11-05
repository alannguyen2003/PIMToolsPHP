<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "employees";
    protected $fillable = ["visa", "first_name", "last_name", "birth_date", "created_at", "updated_at"];
    private $visa;
    private $first_name;
    private $last_name;
    private $birth_date;
    private $created_at;
    private $updated_at;

    // public function __construct($visa, $firstName, $lastName, $birthdate, $createdAt, $updatedAt) {
    //     $this->visa = $visa;
    //     $this->first_name = $firstName;
    //     $this->last_name = $lastName;
    //     $this->birth_date = $birthdate;
    //     $this->created_at = $createdAt;
    //     $this->updated_at = $updatedAt;
    // }

    public function getVisa() {
        return $this->visa;
    }

    public function setVisa($visa) {   
        $this->visa = $visa;
    }

    public function getFirstName() { 
        return $this->first_name;
    }

    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }

    public function getLastName() { 
        return $this->last_name;
    }

    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }

    public function getBirthDate() {
        return $this->birth_date;
    }

    public function setBirthDate($birth_date) {
        $this->birth_date = $birth_date;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }

    public function toResponse() {
        return [
            "visa" => $this->getVisa(),
            "first_name" => $this->getFirstName(),
            "last_name" => $this->getLastName(),
            "birth_date" => $this->getBirthDate(),
            "created_at" => $this->getCreatedAt(),
            "updated_at" => $this->getUpdatedAt()
        ];
    }
    
    public function group() {
        return $this->belongsTo(Group::class, "group_leader_id");
    }
    public function projects() {
        return $this->hasMany(ProjectEmployee::class, );
    }
}
