<?php

namespace App\DTOs\Request\Authenticate;
use App\DTOs\Validation\ValidationConstant;
use Illuminate\Support\Facades\Validator;


class LoginAuthenticate {
  public static function rules() {
    return [
      "username.required" => "Username".ValidationConstant::isRequired(),
      "password.required" => "Password".ValidationConstant::isRequired()  
    ];
  } 

  public static function validator($request) {
    return Validator::make($request->all(), [
        'username' => 'required|string',
        'password' => 'required|string',
    ], LoginAuthenticate::rules());
  } 
}