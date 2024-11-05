<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class EmployeeSeeder extends Seeder { 
  public function run() {
    for ($i = 0; $i < 10; $i++) {
      DB::table("employees")->insert([
        'visa' => 123,
        'first_name' => Str::random(0),
        'last_name'=> Str::random(20),
        'birth_date' => Carbon::today()->subDays(rand(0, 180))
      ]);
    }
  }
}