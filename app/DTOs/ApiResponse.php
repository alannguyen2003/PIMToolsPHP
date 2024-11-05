<?php 

namespace App\DTOs;

class ApiResponse {
  private $statusCode;
  private $message;
  private $data;

  public function __construct($statusCode, $message, $data) {
    $this->statusCode = $statusCode;
    $this->message = $message;
    $this->data = $data;
  }

  public function getStatusCode(): int {
    return $this->statusCode;
  }

  public function getMessage(): string { 
    return $this->message;
  }

  public function getData() {
    return $this->data;
  }
  
  public function setStatusCode($statusCode): void { 
    $this->statusCode = $statusCode;  
  }

  public function setMessage($message) {
    $this->message = $message;
  }

  public function setData($data): void {
    $this->data = $data;
  }

  public function toResponse() {
    return [
      "statusCode" => $this->getStatusCode(),
      "message" => $this->getMessage(),
      "data"=> $this->getData()
    ];
  }
}