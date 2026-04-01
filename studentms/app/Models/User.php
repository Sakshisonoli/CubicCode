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
        'branch_name',
        'location',
        'id_proof',
        'admin_role',
        'role_position',
        'status',
        'profile',
        'password',
        'gst_num',
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

    public function batch(){
        return $this->hasMany(Batch::class, 'branch_id');
    }

    public function faculty(){
        return $this->hasMany(Faculty::class, 'branch_id');
    }

    public function student(){
        return $this->hasMany(Student::class, 'branch_id');
    }

    public function fees(){
        return $this->hasMany(Fees::class, 'branch_id');
    }

    public function leads(){
        return $this->hasMany(Inquiry::class, 'branch_id');
    }

    public function attendance(){
        return $this->hasMany(Attendance::class, 'branch_id');
    }

    public function notification(){
        return $this->hasMany(Notification::class, 'branch_id');
    }

    public function adnotification(){
        return $this->hasMany(Notification::class, 'admin_id');
    }

    public function assignment(){
        return $this->hasMany(Assignment::class, 'branch_id');
    }

    public function submission(){
        return $this->hasMany(Submission::class, 'branch_id');
    }

    public function activity(){
        return $this->hasMany(Activities::class, 'admin_id');
    }

}
