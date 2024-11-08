<?php

namespace Database\Seeders;

use App\Utils\DateExtension;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("roles")->insert([
            "role_name" => "admin",
            "created_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate()),
            "updated_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate())
        ]);

        DB::table("roles")->insert([
            "role_name" => "manager",
            "created_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate()),
            "updated_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate())
        ]);
    }
}
