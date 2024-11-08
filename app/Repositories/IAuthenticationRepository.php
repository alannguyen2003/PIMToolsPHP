<?php

namespace App\Repositories;

interface IAuthenticationRepository {
  public function login($request);
  public function register($request);
  public function profile($request);
  public function forgetPassword($request);
}