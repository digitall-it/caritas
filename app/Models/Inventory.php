<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;

    //fillable
    protected $fillable = [
        'warehouse_id',
        'product_id',
        'quantity',
    ];

//    public function scopeWhereTransaction(Builder $query, StockTransaction $stockTransaction): Builder
//    {
//        return $query
//            ->where('warehouse_id', $stockTransaction->warehouse_id)
//            ->where('product_id', $stockTransaction->product_id);
//    }
    public static function updateFromTransaction(StockTransaction $stockTransaction)
    {
        $quantity = StockTransaction::query()
            ->where('warehouse_id', $stockTransaction->warehouse_id)
            ->where('product_id', $stockTransaction->product_id)
            ->sum('quantity');


        if (self::where('warehouse_id', $stockTransaction->warehouse_id)
            ->where('product_id', $stockTransaction->product_id)
            ->exists()) {
            self::where('warehouse_id', $stockTransaction->warehouse_id)
                ->where('product_id', $stockTransaction->product_id)
                ->update(['quantity' => $quantity]);
        } else {
            self::create([
                'warehouse_id' => $stockTransaction->warehouse_id,
                'product_id' => $stockTransaction->product_id,
                'quantity' => $quantity,
            ]);
        }

        self::where('quantity', 0)->delete();
    }

}
