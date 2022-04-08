<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(ProgramTableSeeder::class);
        $this->call(CourseTableSeeder::class);
        $this->call(OfferTableSeeder::class);
        $this->call(DateTableSeeder::class);
    }
}
