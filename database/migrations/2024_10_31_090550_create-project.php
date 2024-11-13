<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("projects", function (Blueprint $table) {
            $table->id();
            $table->integer("project_number");
            $table->string("name");
            $table->string("status");
            $table->string("customer");
            $table->date("start_date");
            $table->date("end_date");
            $table->integer("group_id")
                    ->references("id")
                    ->on("groups")
                    ->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
