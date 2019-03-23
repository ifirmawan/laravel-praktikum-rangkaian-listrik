<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('users')->insert([
            'name' => 'System Administrator',
            'email' => 'admin@admin.com',
            'photo' => '',
            'phone' => '',
            'role' => 1,
            'NIM' => '14102065',
            'password' => bcrypt('password')
        ]);
    }
}
