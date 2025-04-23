<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'reason',
        'status',
        'leave_type',

    ];

    // Relationship with Employee (If you have an Employee model)
    public function employee()
    {
        return $this->belongsTo(User::class);
    }
}