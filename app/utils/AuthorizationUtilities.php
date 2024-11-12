<?php

namespace App\Utils;

use App\Models\User;

class AuthorizationUtilities {
  public static function isAbleToManage($userId, $role) {
    $userRole = User::find($userId)->role;
    if ($userRole->id == $role) return true;
    return false;
  }
}