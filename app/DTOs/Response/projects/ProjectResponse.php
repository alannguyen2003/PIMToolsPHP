<?php

namespace App\DTOs\Response\Projects;

class ProjectResponse {
  private $projectId;
  private $projectNumber;
  private $name;
  private $customer;
  private $status;
  private $startDate;
  private $endDate;
  
  public function __construct($projectId, $projectNumber, $name, $customer, $status,
                              $startDate, $endDate) {
    $this->projectId = $projectId;
    $this->projectNumber = $projectNumber;
    $this->name = $name;
    $this->customer = $customer;
    switch ($status) {
      case "PLA":
        $this->status = "Planned";
        break;
      case "NEW":
        $this->status = "New";
        break;
      case "INP":
        $this->status = "In Progress";
        break;
      case "FIN":
        $this->status = "Finished";
        break;
      default:
        $this->status = "Unavailable";
    }
    $this->startDate = date_format($startDate, 'Y-m-d');
    if ($endDate === null) $this->endDate = "Not assigned";
    else $this->endDate = $endDate;
  }

  public function toResponse() {
    return [
      "projectId" => $this->projectId,
      "projectNumber" => $this->projectNumber,
      "name" => $this->name,
      "customer" => $this->customer,
      "status" => $this->status,
      "startDate" => $this->startDate,
      "endDate" => $this->endDate
    ];
  }
}