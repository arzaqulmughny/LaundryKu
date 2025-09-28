<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\TransactionPay;
use App\Models\TransactionService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = Transaction::factory(100)->createQuietly();

        $transactions->each(function ($transaction) {
            TransactionService::factory(rand(1, 5))->create([
                'transaction_id' => $transaction->id,
            ]);

            TransactionPay::factory(rand(1, 3))->createQuietly([
                'transaction_id' => $transaction->id,
                'created_by' => 3,
            ]);
        });
    }
}
