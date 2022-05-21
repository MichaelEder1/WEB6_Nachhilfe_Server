<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId("offer_id")->constrained()->onDelete('cascade');
            $table->foreignId("program_id")->constrained()->onDelete('cascade');
            $table->foreignId("course_id")->constrained()->onDelete('cascade');
            $table->bigInteger("tutor_id")->unsigned();
            $table->bigInteger("student_id")->unsigned()->nullable()->default(null);
            $table->foreign("tutor_id")->references('id')->on('users')->onDelete('cascade');
            $table->foreign("student_id")->references('id')->on('users')->onDelete('set null');
            $table->dateTime('date_time');
            $table->boolean('accepted');
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
        Schema::dropIfExists('dates');
    }
}
