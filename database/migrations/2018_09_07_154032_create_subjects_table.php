<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');

            $table->timestamps();
        });

        Schema::create('student_subject', function (Blueprint $table) {
            $table->integer('student_id')->unsigned()->index();
            $table->foreign('student_id')->references('id')
                ->on('students')->onDelete('cascade');

            $table->integer('subject_id')->unsigned()->index();
            $table->foreign('subject_id')->references('id')
                ->on('subjects')->onDelete('cascade');

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
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('student_subject');
    }
}
