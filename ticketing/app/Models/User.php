<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'admin_role',
        'status',
        'profile',
        'last_login',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function sell(){

        return $this->hasMany(Ticket::class, 'owner_id');
    }

    public function purchased(){

        return $this->hasMany(Ticket::class, 'purchaser_id');
    }

    public function info(){

        return $this->hasOne(Paymentsinfo::class, 'customer_id');
    }

    public function biding(){

        return $this->hasMany(Biding::class, 'event_id');
    }

    public function order(){

        return $this->hasMany(Order::class, 'customer_id');
    }
}
