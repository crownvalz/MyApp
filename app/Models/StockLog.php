<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'unit_price',
        'supplier',
        'stock_quantity',
        'requested_by',
        'approved_by',
        'approved_date',
        'status',
        'description',
        'applied_date',
    ];
}