<?php

namespace App\Services\Impl;

use App\Repositories\IUserRepository;
use App\Services\IUserService;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService implements IUserService {
  private $userRepository;

  public function __construct(IUserRepository $userRepository) {
    $this->userRepository = $userRepository;
  }
  public function registerNewUser($data) {
    return $this->userRepository->registerNewUser($data);
  }

  public function createNewToken($token) {
    return [
        'access_token' => $token, 
        'token_type' => 'bearer',
        'expires_in' => JWTAuth::factory()->getTTL() * env("JWT_TTL")
    ];
  }
}