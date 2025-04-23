<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class StationeryRequest extends Model
{
    use HasFactory;

    protected $table = 'requests'; // Ensure this matches your database table name

    protected $fillable = [
        'item_name', 'quantity', 'request_date', 'status', 'requested_by',
    ];
}