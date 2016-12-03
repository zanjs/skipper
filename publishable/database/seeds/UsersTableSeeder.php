<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        \DB::table('users')->insert([
            0 => [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'z@z.com',
                'password'       => bcrypt('skipper'),
                'remember_token' => str_random(60),
                'created_at'     => '2016-12-01 11:20:57',
                'updated_at'     => '2016-12-03 14:32:23',
                'avatar'         => 'users/default.png',
            ],
        ]);
    }
}
