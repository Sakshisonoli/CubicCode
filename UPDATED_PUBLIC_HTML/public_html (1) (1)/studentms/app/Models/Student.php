<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
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
        'admission_date',
        'enrolled_course',
        'course_id',
        'enquiry_date',
        'course_enquiry',
        'join_status',
        'branch_id',
        'batch_id',
        'payment_type',
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

    public function batch(){
        return $this->belongsTo(Batch::class, 'batch_id', 'id');
    }

    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function fees(){
        return $this->hasMany(Fees::class, 'student_id');
    }

    public function attendance(){
        return $this->hasMany(Attendance::class, 'student_id');
    }

    public function notification(){
        return $this->hasMany(Notification::class, 'student_id');
    }

    public function assignment(){
        return $this->hasMany(Assignment::class, 'student_id');
    }

    public function submission(){
        return $this->hasMany(Submission::class, 'student_id');
    }

    public function activity(){
        return $this->hasMany(Activities::class, 'student_affected');
    }

}
