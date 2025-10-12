<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $materials = [
            ['name' => 'Baju Katun', 'unit' => 'pcs', 'price_min' => 5000, 'price_max' => 20000, 'stock_max' => 500],
            ['name' => 'Detergen Cair', 'unit' => 'ltr', 'price_min' => 10000, 'price_max' => 50000, 'stock_max' => 200],
            ['name' => 'Plastik Kantong', 'unit' => 'pcs', 'price_min' => 500, 'price_max' => 2000, 'stock_max' => 1000],
            ['name' => 'Pewangi Laundry', 'unit' => 'ltr', 'price_min' => 15000, 'price_max' => 60000, 'stock_max' => 100],
            ['name' => 'Sisir Laundry', 'unit' => 'pcs', 'price_min' => 1000, 'price_max' => 10000, 'stock_max' => 300],
        ];

        $material = $this->faker->randomElement($materials);

        return [
            'name' => $material['name'],
            'description' => $this->faker->optional()->sentence(),
            'unit' => $material['unit'],
            'last_price' => $this->faker->randomFloat(2, $material['price_min'], $material['price_max']),
            'available_stock' => $this->faker->randomFloat(2, 0, $material['stock_max']),
            'active' => $this->faker->boolean(95)
        ];
    }
}
