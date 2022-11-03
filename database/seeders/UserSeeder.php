<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create filament admin
        User::factory()->create([
            'name' => 'Giancarlo',
            'surname' => 'Di Massa',
            'email' => 'giancarlo@digitall.it',
            'phone' => '3391491976',
            'password' => Hash::make('ciccioformaggio'),
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'Salvatore',
            'surname' => 'Pisani',
            'email' => 'sp.bunz@gmail.com',
            'phone' => '3204890211',
            'password' => Hash::make('12341234'),
            'email_verified_at' => now(),
        ]);

//        User::factory()->count(50)->create();
    }
}
