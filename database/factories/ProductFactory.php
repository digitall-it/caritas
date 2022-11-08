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
        $prodotti = [
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
        ];

        return [
            'name' => $prodotti[rand(0, 16)],
            'barcode' => rand(123456789, 987654321),
        ];
    }
}
