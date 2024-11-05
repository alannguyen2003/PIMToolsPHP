<?php

namespace App\DTOs\Request\Employee;

class CreateEmployeeRequest {
  private $visa;
  private $first_name;
  private $last_name;
  private $birth_date;

  public function __construct($visa, $first_name, $last_name, $birth_date) {
    $this->visa = $visa;
    $this->first_name = $first_name;  
    $this->last_name = $last_name;
    $this->birth_date = $birth_date;
  }

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

  public function toResponse() {
    return [
      "visa" => $this->getVisa(),
      "first_name"=> $this->getFirstName(),
      "last_name"=> $this->getLastName(),
      "birth_date"=> $this->getBirthDate(),
    ];
  }

}