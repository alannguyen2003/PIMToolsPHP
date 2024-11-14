<?php

namespace App\Utils\Mappers;

use App\DTOs\Response\Projects\ProjectResponse;

class ProjectMapper {
  public function mapToResponse($project) {
    $projectResponse = new ProjectResponse(
      $project->id,
      $project->projectNumber,
      $project->name,
      $project->customer, 
      $project->status,
      $project->startDate,
      $project->endDate
    );
    return $projectResponse->toResponse();
  }
}