<?php

namespace Database\Seeders;

use App\Models\Date;
use App\Models\Offer;
use App\Models\User;
use DateTime;
use Illuminate\Database\Seeder;

class DateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date1 = new Date();

        $offer1 = Offer::all()->first();

        $course1 = $offer1->courses()->first();
        $program1 = $offer1->programs()->first();
        $tutor = $offer1->users()->first();
        $student = User::all()->skip(1)->first();

        $date1->accepted = false;
        $date1->date_time = new DateTime();
        $date1->offers()->associate($offer1);
        $date1->courses()->associate($course1);
        $date1->programs()->associate($program1);
        $date1->students()->associate($student);
        $date1->tutors()->associate($tutor);
        $date1->save();
    }
}
