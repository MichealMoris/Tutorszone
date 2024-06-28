<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ar_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_image');
            $table->string('teacher_name');
            $table->string('teacher_subject');
            $table->string('teacher_country');
            $table->text('teacher_description');
            $table->text('teacher_color');
            $table->string('lang')->default('ar');
            $table->softDeletes();
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
        Schema::dropIfExists('teacher_ars');
    }
}
