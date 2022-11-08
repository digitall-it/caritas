<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(
                [
                    'Caffe',
                    'Fette biscottate',
                    'Biscotti',
                    'Marmellata',
                    'Legumi',
                    'Pasta',
                    'Passate di pomodoro',
                    'Pelea',
                    'Zucchero',
                    'Farina',
                    'Carne in scatola',
                    'Crackers',
                    'Crostate',
                    'Riso',
                    'Cornetti',
                    'Succhi di frutta',
                    'Salumi',
                    'Formaggi',
                ]
            ),
            'barcode' => $this->faker->unique()->randomNumber(9),
        ];
    }
}
