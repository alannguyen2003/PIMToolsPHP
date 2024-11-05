<?php

namespace App\DTOs\Request\Employee;

class UpdateEmployeeRequest {
  private $id;
  private $visa;
  private $firstName;
  private $lastName;
  private $birthdate;

  public function __construct($id, $visa, $firstName, $lastName, $birthdate) {
    $this->id = $id;
    $this->visa = $visa;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->birthdate = $birthdate;
  }

  public function getId() {
    return $this->id;
  }

  public function getVisa() {
    return $this->visa;
  }

  public function setVisa($visa) {
    $this->visa = $visa;
  }

  public function getFirstName() {
    return $this->firstName;
  }

  public function setFirstName($firstName) {
    $this->firstName = $firstName;
  }

  public function getLastName() {
    return $this->lastName;
  }

  public function setLastName($lastName) {
    $this->lastName = $lastName;
  }

  public function getBirthdate() {
    return $this->birthdate;
  }

  public function setBirthdate($birthdate) {
    $this->birthdate = $birthdate;
  }
}