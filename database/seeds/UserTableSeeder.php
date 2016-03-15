<?php

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
        DB::table('user')->insert([
            'email'         => 'stefano@moodles.nl',
            'password'      => bcrypt('moodles'),
            'firstname'     => 'Stefano',
            'lastname'      => 'Groenland',
            'profile_photo' => str_random(5),
            'phone_number'  => str_random(5),
            'user_rank'     => 'admin',
        ]);
    }
}
