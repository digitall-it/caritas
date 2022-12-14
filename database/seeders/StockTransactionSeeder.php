<?php

namespace Database\Seeders;

use App\Models\StockTransaction;
use Illuminate\Database\Seeder;

class StockTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StockTransaction::factory()->count(50)->create();
    }
}
