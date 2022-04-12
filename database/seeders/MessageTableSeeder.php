<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Offer;
use App\Models\User;
use DateTime;
use Illuminate\Database\Seeder;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $message1 = new Message();

        $offer1 = Offer::all()->skip(1)->first();

        $course1 = $offer1->courses()->first();
        $program1 = $offer1->programs()->first();
        $tutor = $offer1->users()->first();
        $student = User::all()->first();

        $message1->text = 'Hallo, geht bei dir auch an diesem Tag? LG';
        $message1->date_time = new DateTime();
        $message1->offers()->associate($offer1);
        $message1->courses()->associate($course1);
        $message1->programs()->associate($program1);
        $message1->students()->associate($student);
        $message1->tutors()->associate($tutor);
        $message1->save();
    }
}
