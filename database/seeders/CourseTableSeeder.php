<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Program;
use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course1 = new Course();
        $course1->course_name = "Web- und Hypermedia";
        $course1->semester = 2;

        /* add connection to program */
        $program1 = Program::all()->first();
        $course1->programs()->associate($program1);
        $course1->save();

        $course2 = new Course();
        $course2->course_name = "Softwareentwicklung mit modernen Plattformen";
        $course2->semester = 4;

        /* add connection to program */
        $program2 = Program::all()->skip(1)->first();
        $course2->programs()->associate($program2);
        $course2->save();

        $course3 = new Course();
        $course3->course_name = "Hardwarenahe Programmierung";
        $course3->semester = 3;

        /* add connection to program */
        $program3 = Program::all()->skip(2)->first();
        $course3->programs()->associate($program3);
        $course3->save();

        $course4 = new Course();
        $course4->course_name = "Stop Motion Animation";
        $course4->semester = 5;

        /* add connection to program */
        $program4 = Program::all()->skip(3)->first();
        $course4->programs()->associate($program4);
        $course4->save();
    }
}
