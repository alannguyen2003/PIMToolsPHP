<?php

namespace App\DTOs\Request\Group;

class CreateGroupRequest {
  private $groupLeaderId;

  public function __construct($groupLeaderId) {
    $this->groupLeaderId = $groupLeaderId;
  }

  public function getGroupLeaderId() {
    return $this->groupLeaderId;
  }

  public function setGroupLeaderId($groupLeaderId) {
    $this->groupLeaderId = $groupLeaderId;
  }
}