<?php

namespace App\Repositories\Impl;

use App\Constant\AllTablesConstant;
use App\Models\User;
use App\Repositories\IUserRepository;
use App\Utils\DateExtension;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository {
  public function registerNewUser($data) {
    $user = User::where('username', '=', $data->username)->first();
    if ($user === null) {
      $newUser = User::create([
        "fullname" => $data->fullname,
        "username" => $data->username,
        "password" => Hash::make($data->password),
        "role_id" => 2,
        "created_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate()),
        "updated_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate())
      ]);
      return $newUser;
    }
    return 0;
  }
}