<?php

namespace Database\Seeders;

use App\Models\Date;
use App\Models\Offer;
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

        $course1 = $offer1->course()->first();
        $program1 = $offer1->program()->first();
        $tutor = $offer1->user()->first();
        $student = null;

        $date1->accepted = false;
        $date1->date_time = new DateTime();
        $date1->offer()->associate($offer1);
        $date1->course()->associate($course1);
        $date1->program()->associate($program1);
        $date1->student()->associate($student);
        $date1->tutor()->associate($tutor);
        $date1->save();
    }
}
