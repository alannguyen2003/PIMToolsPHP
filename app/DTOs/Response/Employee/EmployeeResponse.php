<?php

namespace App\DTOs\Response\Employee;

class EmployeeResponse {
  private $visa;
  private $firstName;
  private $lastName;
  private $birthdate;

  public function __construct($visa, $firstName, $lastName, $birthdate) {
    $this->visa = $visa;  
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->birthdate = $birthdate;
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

  public function getBirthDate() {
    return $this->birthdate;
  }

  public function setBirthDate($birthdate) {
    $this->birthdate = $birthdate;
  }
}