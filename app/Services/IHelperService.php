<?php 

namespace App\Services;

interface IHelperService {
  public function response(bool $isSuccess, string $report, $details, $errors, $responseCode);
}