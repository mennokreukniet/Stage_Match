<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_skill', function (Blueprint $table) {
            $table->unsignedInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedInteger('skill_id');
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->unsignedInteger('level_id');
            $table->foreign('level_id')->references('id')->on('level')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_skill');
    }
}
