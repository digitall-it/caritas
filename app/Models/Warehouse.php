<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'inventories')->withPivot('quantity');
    }

    public function stock_transactions()
    {
        return $this->hasMany(StockTransaction::class, 'warehouse_id');
    }
}
