<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();

        $user->first_name="Maria";
        $user->last_name="Huber";
        $user->age=22;
        $user->photo="https://images.unsplash.com/photo-1596495578065-6e0763fa1178";
        $user->email="maria.huber@fhooe.at";
        $user->password= bcrypt("verySecretPassword!");
        $user->phone_number="+43664123456780";
        $user->education="KWM";
        $user->degree="Bachelor";
        $user->semester=4;
        $user->save();

        $user2 = new User();

        $user2->first_name="Martin";
        $user2->last_name="Koll";
        $user2->age=24;
        $user2->photo="https://images.unsplash.com/photo-1596495717788-01458887290b";
        $user2->email="martin.koll@fhooe.at";
        $user2->password= bcrypt("alsoAVerySecretPassword!");
        $user2->phone_number="+43660147852369";
        $user2->education="SE";
        $user2->degree="Master";
        $user2->semester=2;
        $user2->role=0;
        $user2->save();
    }
}
