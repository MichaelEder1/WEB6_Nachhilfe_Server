<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $program1 = new Program();
        $program1->program_name = "KWM";
        $program1->save();

        $program2 = new Program();
        $program2->program_name = "SE";
        $program2->save();

        $program3 = new Program();
        $program3->program_name = "HSD";
        $program3->save();

        $program4 = new Program();
        $program4->program_name = "MTD";
        $program4->save();
    }
}
