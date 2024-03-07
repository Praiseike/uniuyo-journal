<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Paper;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        \App\Models\Role::create([
            'name' => 'user',
        ]);

        \App\Models\Role::create([
            'name' => 'reviewer',
        ]);

        \App\Models\Role::create([
            'name' => 'admin',
        ]);

        \App\Models\User::create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'admin@gmail.com',
            'password' => \Hash::make('pa33word**')
        ]);

        \App\Models\Transaction::create([
            'user_id' => 1,
            'status' => 'paid',
            'amount' => 10000,
            'transactionId' => 'T_ILAJR4298784IL',
        ]);

        \App\Models\PaperStatus::create([
            'name' => 'paid',
            'value' => 'paid',
        ]);

        Paper::factory()->count(10)->create();

    }
}
