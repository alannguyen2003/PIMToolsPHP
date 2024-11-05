<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("projects_employees", function (Blueprint $table) {
            $table->integer("employee_id") 
                    ->references("id")
                    ->on("employees")
                    ->onDelete("cascade");
            $table->integer("project_id")
                    ->references("id")
                    ->on("projects")
                    ->onDelete("cascade");
            $table->primary(["employee_id","project_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
