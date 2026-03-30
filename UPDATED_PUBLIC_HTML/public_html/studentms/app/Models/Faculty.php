<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Faculty extends Authenticatable
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
        'address',
        'adhar_number',
        'birth_date',
        'gender',
        'nationality',
        'marital_status',
        'role',
        'department',
        'education',
        'experience',
        'work_status',
        'branch_id',
        'cid',
        'note',
        'status',
        'profile',
        'password'
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

    public function branch(){

        return $this->belongsTo(User::class, 'branch_id', 'id');
    }

    public function inquiry(){

        return $this->hasMany(Inquiry::class, 'seller_id');
    }

    public function notification(){
        return $this->hasMany(Notification::class, 'faculty_id');
    }

    public function activity(){
        return $this->hasMany(Activities::class, 'faculty_affected');
    }

}
