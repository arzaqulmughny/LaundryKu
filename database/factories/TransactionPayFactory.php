<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\TransactionPay;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionPayFactory extends Factory
{
    protected $model = TransactionPay::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transactionId = Transaction::inRandomOrder()->first()?->id ?? 1;

        return [
            'transaction_id' => $transactionId,
            'amount' => $this->faker->randomFloat(2, 10, 5000),
            'created_by' => $this->faker->numberBetween(1, 10),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
        ];
    }
}
