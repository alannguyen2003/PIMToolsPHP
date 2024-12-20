<?php

namespace App\Utils\Mappers;

use App\DTOS\Response\Employee\EmployeeResponse;
use App\Utils\DateExtension;
use App\Models\Employee;

class EmployeeMapper {

  // ---> Map To Response
  public static function mapToEmployeeResponse($data) {
    return new EmployeeResponse($data->visa, $data->first_name, 
                            $data->last_name, $data->birth_date);
  }

  // ---> Map to Array
  public static function mapToArray($data) {
    return [
      "visa" => $data->visa,
      "first_name"=> $data->firstName,
      "last_name"=> $data->lastName,
      "birth_date" => $data->birthdate,
      "created_at" => $data->createdAt,
      "updated_at" => $data->updatedAt
    ];
  }
}