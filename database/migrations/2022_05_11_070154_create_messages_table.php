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
            $table->date('date_time');
            $table->bigInteger("tutors_id")->unsigned()->nullable();
            $table->bigInteger("students_id")->unsigned()->nullable();
            $table->foreign("tutors_id")->references('id')->on('users')->onDelete('set null');
            $table->foreign("students_id")->references('id')->on('users')->onDelete('set null');
            $table->foreignId('courses_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('offers_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('programs_id')->nullable()->constrained()->onDelete('set null');
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
