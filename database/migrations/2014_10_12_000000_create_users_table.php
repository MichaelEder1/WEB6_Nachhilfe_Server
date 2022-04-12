<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateUsersTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('first_name');
                $table->string('last_name');
                $table->integer('age');
                $table->string("photo")->nullable()->default(null);
                $table->string("mail");
                $table->string("password");
                $table->string("phone_number")->nullable()->default(null);
                $table->string("education");
                $table->enum("degree", ['Bachelor', 'Master', 'Doktorat', 'Sonstiges']);
                $table->enum("semester", [1, 2, 3, 4, 5, 6]);
                $table->boolean("role")->default('1'); //0 = Anbieter; 1 = Suchender
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
            Schema::dropIfExists('users');
        }
    }
