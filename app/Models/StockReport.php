<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'description',
        'stock_before',
        'requested_quantity',
        'balance',
        'requested_by',
        'applied_date',
        'approved_date',
        'approved_by',
    ];

    protected $dates = [
        'applied_date',
        'approved_date',
    ];
}