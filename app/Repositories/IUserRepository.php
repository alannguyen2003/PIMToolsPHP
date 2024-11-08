<?php

namespace App\Repositories;

interface IUserRepository {
  public function registerNewUser($data);
}