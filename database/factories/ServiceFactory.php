<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            'Cuci',
            'Setrika',
            'Cuci + Setrika',
            'Cuci Kering',
            'Cuci Lipat',
            'Dry Cleaning',
            'Laundry Satuan',
            'Laundry Express',
            'Cuci Sprei & Bedcover',
            'Cuci Karpet',
        ];
        return [
            'name' => $this->faker->randomElement($names),
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'unit' => $this->faker->randomElement(['kg', 'pcs']),
            'active' => $this->faker->boolean,
        ];
    }
}
