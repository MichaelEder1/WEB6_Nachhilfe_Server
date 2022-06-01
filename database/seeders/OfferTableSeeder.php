<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Seeder;

class OfferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offer1 = new Offer();

        $offer1->title = "JavaScript Basics";
        $offer1->information = "Basics wie Variablen, Schleifen, Funktionen, DOM-Manipulation";

        $course1 = Course::all()->first();
        $program1 = $course1->program;
        $user1 = User::all()->first();

        $offer1->course()->associate($course1);
        $offer1->user()->associate($user1);
        $offer1->program()->associate($program1);

        $offer1->save();

        $offer2 = new Offer();

        $offer2->title = "Fortgeschrittene Konzepte";
        $offer2->information = "Fortgeschrittene Konzepte in XY";

        $course2 = Course::all()->skip(1)->first();
        $program2 = $course2->program;
        $user2 = User::all()->skip(1)->first();

        $offer2->course()->associate($course2);
        $offer2->user()->associate($user2);
        $offer2->program()->associate($program2);

        $offer2->save();
    }
}
