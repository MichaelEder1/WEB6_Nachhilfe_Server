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
                $table->foreignId("offers_id")->constrained()->onDelete('cascade');
                $table->foreignId("programs_id")->constrained()->onDelete('cascade');
                $table->bigInteger("tutors_id")->unsigned();
                $table->bigInteger("seekers_id")->unsigned();
                $table->foreign("tutors_id")->references('id')->on('users');
                $table->foreign("seekers_id")->references('id')->on('users');
                $table->date('date_time');
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
