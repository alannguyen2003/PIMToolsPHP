<?php

namespace Database\Seeders;

use App\Utils\DateExtension;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for( $i = 0; $i < 10; $i++ ) {
            DB::table("groups")->insert([
                'group_leader_id' => rand(0, 10),
                "created_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate()),
                "updated_at" => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate())
            ]);

            // DB::table("groups")->where('id', '=', $i)
            // ->update([
            //     'created_at' => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate()),
            //     'updated_at' => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate())
            // ]);
            
            // DB::table("groups")->where('id', '=', 10)
            // ->update([
            //     'created_at' => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate()),
            //     'updated_at' => DateExtension::getDateTimeByFormat(DateExtension::getCurrentDate())
            // ]);
        }
    }
}
