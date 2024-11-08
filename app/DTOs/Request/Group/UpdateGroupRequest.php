<?php

namespace App\DTOs\Request\Group; 

class UpdateGroupRequest {
  private $id;
  private $groupLeaderId;

  public function __construct($id, $groupLeaderId) {
    $this->id = $id;
    $this->groupLeaderId = $groupLeaderId;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getGroupLeaderId() {
    return $this->groupLeaderId;
  }

  public function setGroupLeaderId($groupLeaderId) {
    $this->groupLeaderId = $groupLeaderId;
  }
}