<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder {
  public function run() {
    for ($i = 0; $i < 10; $i++) {
      DB::table("projects")->insert([
        ""
      ]);
    }
  }
}
