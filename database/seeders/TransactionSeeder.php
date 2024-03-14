<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Transaction::create([
            'user_id' => 1,
            'status' => 'paid',
            'amount' => 10000,
            'transactionId' => 'T_ILAJR4298784IL',
        ]);


    }
}
