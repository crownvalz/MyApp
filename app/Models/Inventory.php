<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    // Define the table name (optional if the table name follows Laravel's conventions)
    protected $table = 'inventory';

    // Define which attributes are mass assignable
    protected $fillable = [
        'item_name',
        'description',
        'supplier',
        'stock_before',
        'unit_price',
        'restocked_quantity',
        'balance',
        'requested_by',
        'applied_date',
        'status',
        'approved_date',
        'approved_by',
    ];

    // Define any relationships if necessary
    // For example, if you have a User model and want to associate restocked_by with the User's id:
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'restocked_by');
    // }
}