<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
    }
}
