<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\TransactionService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionService>
 */
class TransactionServiceFactory extends Factory
{
    protected $model = TransactionService::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transactionId = Transaction::inRandomOrder()->first()?->id ?? 1;

        $price = $this->faker->randomFloat(2, 10000, 100000);
        $quantity = $this->faker->randomFloat(2, 1, 10);

        return [
            'transaction_id' => $transactionId,
            'service_id' => $this->faker->numberBetween(1, 10),
            'service_name' => $this->faker->word(),
            'service_unit' => $this->faker->randomElement(['kg', 'pcs', 'jam']),
            'service_price' => $price,
            'quantity' => $quantity,
            'total' => round($price * $quantity, 2),
        ];
    }
}
