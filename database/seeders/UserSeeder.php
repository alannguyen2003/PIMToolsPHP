<?php

namespace Database\Seeders;

use App\Constant\AllTablesConstant;
use App\Utils\DateExtension;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 10; $i++) {
            DB::table(AllTablesConstant::USERS_TABLE)->insert([
                "fullname" => Str::random(30),
                "username" => Str::random(15),
                "password" => Hash::make("123456"),
                "role_id" => rand(1,2),
                "created_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate()),
                "updated_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate())
            ]);
        }
    }
}
