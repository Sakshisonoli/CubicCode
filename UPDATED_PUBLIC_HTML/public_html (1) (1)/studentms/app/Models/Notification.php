<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'title',
        'message',
        'type',
        'status',
        'admin_id',
        'branch_id',
        'student_id',
        'faculty_id'
    ];

    public function admin(){
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    public function branch(){
        return $this->belongsTo(User::class, 'branch_id', 'id');
    }

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }
}
