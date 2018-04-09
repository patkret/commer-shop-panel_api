<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->first_name = 'admin';
        $user->last_name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->phone_no = '555 555 555';
        $user->password = bcrypt('admin');
        $user->save();
    }
}
