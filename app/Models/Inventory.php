<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    //fillable
    protected $fillable = [
        'warehouse_id',
        'product_id',
        'quantity',
    ];
}
