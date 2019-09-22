<?php

use Illuminate\Database\Seeder;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
              'name' => 'admin',
              'email' => 'admin@mail.com',
              'password' => Hash::make('123456'),
              'type' => 'Admin',
        ]);
    }
}
