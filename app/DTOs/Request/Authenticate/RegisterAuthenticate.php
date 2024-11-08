<?php

namespace App\DTOs\Request\Authenticate;

use App\DTOs\Validation\ValidationConstant;
use Illuminate\Support\Facades\Validator;

class RegisterAuthenticate {
  public static function rules(){
    return [
      "fullname.required" => "Fullname".ValidationConstant::isRequired(),
      "fullname.max:255" => "Fullname".ValidationConstant::lessThanExpectedCharacters(255),
  
      "username.required" => "Username".ValidationConstant::isRequired(),
      "username.max:32" => "Username".ValidationConstant::lessThanExpectedCharacters(32),
      "username.min:6" => "Username".ValidationConstant::longerThanExpectedCharacters(6),
  
      "password.required" => "Password".ValidationConstant::isRequired(),
      "password.min:8" => "Password".ValidationConstant::longerThanExpectedCharacters(8),
      "password:max:40" => "Password".ValidationConstant::lessThanExpectedCharacters(40)
    ];
  }

  public static function validator($request) {
    return Validator::make($request->all(), [
      "fullname" => "required|max:255",
      "username" => "required|min:6|max:32",
      "password" => "required|min:8|max:40"
  ], RegisterAuthenticate::rules());
  } 

  
}