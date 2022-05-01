<?php

    namespace Database\Seeders;

    use App\Models\Course;
    use App\Models\Offer;
    use App\Models\Program;
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
            $program1 = $course1->programs;
            $user1 = User::all()->first();

            $offer1->courses()->associate($course1);
            $offer1->users()->associate($user1);
            $offer1->programs()->associate($program1);

            $offer1->save();

            $offer2 = new Offer();

            $offer2->title="Fortgeschrittene Konzepte";
            $offer2->information="Fortgeschrittene Konzepte in XY";

            $course2 = Course::all()->skip(1)->first();
            $program2 = $course2->programs;
            $user2 = User::all()->skip(1)->first();

            $offer2->courses()->associate($course2);
            $offer2->users()->associate($user2);
            $offer2->programs()->associate($program2);

            $offer2->save();
        }
    }
