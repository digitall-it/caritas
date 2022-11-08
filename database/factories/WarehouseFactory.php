<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warehouse>
 */
class WarehouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //'name' => $offices[rand(0, 2)],
            // name is a random unique value from the array
            'name' => $this->faker->unique()->randomElement([
                'Lacco Ameno',
                'Ischia',
                'Forio',
                'Casamicciola',
                'Sant\'Angelo',
                'Barano',
                'Serrara Fontana',
            ]),
            // 'name' => $this->faker->name,
        ];
    }
}
