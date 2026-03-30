<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_name',
        'batch_time',
        'course_name',
        'course_id',
        'branch_id',
        'faculty_id',
        'total_students',
        'start_date',
        'end_date'
    ];

    public function branch(){
        return $this->belongsTo(User::class, 'branch_id', 'id');
    }

    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }

    public function student(){
        return $this->hasMany(Student::class, 'batch_id');
    }

    public function attendance(){
        return $this->hasMany(Attendance::class, 'batch_id');
    }

    public function assignment(){
        return $this->hasMany(Assignment::class, 'batch_id');
    }
}
