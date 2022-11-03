<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_transactions', function (Blueprint $table) {

            $table->primary(['product_id', 'warehouse_id']);

            $table->integer('quantity')->default(0);

            $table->foreignIdFor(\App\Models\Product::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Warehouse::class)->constrained()->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_transactions');
    }
};
