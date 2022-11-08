<?php

namespace Tests\Unit;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

//use Illuminate\Foundation\Testing\WithFaker;
//use PHPUnit\Framework\TestCase;

class InventoryTest extends TestCase
{
//    use TestCase;
    //use DatabaseMigrations;
    use RefreshDatabase;

    //use InteractsWithDatabase;
    //use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_inventory_created_if_not_exists_from_new_transaction()
    {
        $warehouse = Warehouse::factory()->create();
        $product = Product::factory()->create();
        $quantity = random_int(1, 100);

        $stockTransaction = StockTransaction::factory()->create([
            'warehouse_id' => $warehouse->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        $this->assertDatabaseHas('inventories', [
            'warehouse_id' => $warehouse->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_inventory_created_if_not_exists_from_updated_transaction()
    {
        $warehouse = Warehouse::factory()->create();
        $product = Product::factory()->create();
        $quantity = random_int(1, 100);

        $stockTransaction = StockTransaction::factory()->create([
            'warehouse_id' => $warehouse->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        Inventory::where('warehouse_id', $stockTransaction->warehouse_id)
            ->where('product_id', $stockTransaction->product_id)
            ->delete();

        $this->assertDatabaseMissing('inventories', [
            'warehouse_id' => $warehouse->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        $stockTransaction->quantity = $quantity * 2;
        $stockTransaction->save();

        $this->assertDatabaseHas('inventories', [
            'warehouse_id' => $warehouse->id,
            'product_id' => $product->id,
            'quantity' => $quantity * 2,
        ]);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_inventory_deleted_quantity_is_zero()
    {
        $warehouse = Warehouse::factory()->create();
        $product = Product::factory()->create();
        $quantity = random_int(1, 100);

        StockTransaction::factory()->create([
            'warehouse_id' => $warehouse->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        StockTransaction::factory()->create([
            'warehouse_id' => $warehouse->id,
            'product_id' => $product->id,
            'quantity' => -$quantity,
        ]);

        $this->assertDatabaseMissing('inventories', [
            'warehouse_id' => $warehouse->id,
            'product_id' => $product->id,
        ]);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_inventory_updated_if_exists_from_new_transaction()
    {
        $warehouse = Warehouse::factory()->create();
        $product = Product::factory()->create();

        $quantity1 = random_int(1, 100);

        StockTransaction::factory()->create([
            'warehouse_id' => $warehouse->id,
            'product_id' => $product->id,
            'quantity' => $quantity1,
        ]);

        $quantity2 = random_int(1, 100);

        StockTransaction::factory()->create([
            'warehouse_id' => $warehouse->id,
            'product_id' => $product->id,
            'quantity' => $quantity2,
        ]);

        $this->assertDatabaseHas('inventories', [
            'warehouse_id' => $warehouse->id,
            'product_id' => $product->id,
            'quantity' => $quantity1 + $quantity2,
        ]);

        $this->assertEquals(1, Inventory::where('warehouse_id', $warehouse->id)
            ->where('product_id', $product->id)
            ->count());
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_inventory_updated_if_exists_from_updated_transaction()
    {
        $warehouse = Warehouse::factory()->create();
        $product = Product::factory()->create();

        $quantity1 = random_int(1, 100);

        $t1 = StockTransaction::factory()->create([
            'warehouse_id' => $warehouse->id,
            'product_id' => $product->id,
            'quantity' => $quantity1,
        ]);

        $quantity2 = random_int(1, 100);

        $t2 = StockTransaction::factory()->create([
            'warehouse_id' => $warehouse->id,
            'product_id' => $product->id,
            'quantity' => $quantity2,
        ]);

        $quantity3 = random_int(1, 100);

        $t1->quantity = $quantity3;
        $t1->save();

        $this->assertDatabaseHas('inventories', [
            'warehouse_id' => $warehouse->id,
            'product_id' => $product->id,
            'quantity' => $quantity3 + $quantity2,
        ]);

        $this->assertEquals(1, Inventory::where('warehouse_id', $warehouse->id)
            ->where('product_id', $product->id)
            ->count());
    }
}
