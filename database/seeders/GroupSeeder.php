<?php

namespace Database\Seeders;

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
                'group_leader_id' => rand(0, 10)
            ]);
        }
    }
}
