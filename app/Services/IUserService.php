<?php 

namespace App\Services;

interface IUserService {
  public function registerNewUser($data);
  public function createNewToken($token);
}