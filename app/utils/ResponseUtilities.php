<?php

namespace App\Utils;

use App\Constant\ApiResponseConstant;
use App\DTOs\ApiResponse;

class ResponseUtilities {
  public static function returnResponse($statusCode, $message, $data) {
    $response = new ApiResponse(
      $statusCode, 
      $message, 
      $data
    );
    return $response->toResponse();
  }
}