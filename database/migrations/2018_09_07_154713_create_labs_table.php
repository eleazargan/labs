<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('day');
            $table->string('location');
            $table->double('lat');
            $table->double('long');
            $table->time('start_time');
            $table->time('end_time');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('week');
            $table->string('status');

            $table->integer('subject_id')->unsigned()->index();
            $table->foreign('subject_id')->references('id')
                ->on('subjects')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('lab_student', function (Blueprint $table) {
            $table->integer('student_id')->unsigned()->index();
            $table->foreign('student_id')->references('id')
                ->on('students')->onDelete('cascade');

            $table->integer('lab_id')->unsigned()->index();
            $table->foreign('lab_id')->references('id')
                ->on('labs')->onDelete('cascade');

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
        Schema::dropIfExists('labs');
        Schema::dropIfExists('lab_student');
    }
}
