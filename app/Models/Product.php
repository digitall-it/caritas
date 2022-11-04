<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class, 'inventories')->withPivot('quantity');
    }

    public function stock_transactions()
    {
        return $this->hasMany(StockTransaction::class, 'product_id');
    }
}
