<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween('-1 year', 'now');

        return [
            'date' => $date->format('Y-m-d'),
            'due_date' => $this->faker->dateTimeBetween($date, '+1 month')->format('Y-m-d'),
            'status' => $this->faker->numberBetween(0, 2),
            'attachment' => $this->faker->optional()->filePath(),
            'payment_status' => $this->faker->numberBetween(0, 2),
            'total' => $this->faker->randomFloat(2, 100, 10000),
            'total_paid' => 0,
            'customer_id' => $this->faker->numberBetween(1, 1000),
            'created_by' => 3
        ];
    }
}
