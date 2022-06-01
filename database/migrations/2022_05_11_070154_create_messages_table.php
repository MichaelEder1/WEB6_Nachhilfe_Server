<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->dateTime('date_time');
            $table->bigInteger("tutor_id")->unsigned()->nullable();
            $table->bigInteger("student_id")->unsigned()->nullable();
            $table->foreign("tutor_id")->references('id')->on('users')->onDelete('set null');
            $table->foreign("student_id")->references('id')->on('users')->onDelete('set null');
            $table->foreignId('course_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('offer_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('program_id')->nullable()->constrained()->onDelete('set null');
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
        Schema::dropIfExists('messages');
    }
}
