<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'birth_date',
        'gender',
        'national_id',
        'position',
        'department',
        'branch',
        'reg_status',
        'role',
        'salary',
        'leave_bal',
        'hire_date',
        'status',
        'employment_type',
        'emergency_contact',
        'email_verified_at',
        'password',
    
        // Newly added fields
        'supervisor_id',
        'contract_end',
        'bank_acc',
        'bank_name',
        'marital_status',
        'profile_pic',
        'last_login',
        'confirm_date',
        'blood_type',
        'disability_status',
        'resign_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
