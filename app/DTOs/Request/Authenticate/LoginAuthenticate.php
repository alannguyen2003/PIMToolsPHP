<?php

namespace App\DTOs\Request\Authenticate;
use Illuminate\Support\Facades\Validator;


class LoginAuthenticate {
  public const rules = [
    "username.required" => "Username is required!",
    "password.required" => "Password is required!"  
  ];

  public const validator = Validator::make($request->all(), [
      'username' => 'required|string',
      'password' => 'required|string',
  ], $rules);

}