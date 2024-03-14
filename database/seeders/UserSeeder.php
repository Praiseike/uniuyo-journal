<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\User::create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'admin@gmail.com',
            'password' => \Hash::make('pa33word**'),
            'role_id' => \App\Models\Role::where('name','admin')->first()->id,
        ]);

    }
}
