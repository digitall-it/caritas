<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'product_id',
        'quantity',
        'notes',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    protected static function booted()
    {
        static::created(function ($stockTransaction) {
//            $stockTransaction->updateInventory();
            Inventory::updateFromTransaction($stockTransaction);
        });
        static::updated(function ($stockTransaction) {
//            $stockTransaction->updateInventory();
            Inventory::updateFromTransaction($stockTransaction);
        });
    }

    public function getNameAttribute()
    {
        return ($this->quantity > 0 ? 'Carico' : 'Scarico').' di '.$this->quantity.' '.$this->product->name.' a '.$this->warehouse->name;
    }
}
