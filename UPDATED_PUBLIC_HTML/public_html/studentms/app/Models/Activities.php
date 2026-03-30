<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'action',
        'student_affected',
        'faculty_affected',
        'status'
    ];

    public function admin(){
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    public function student(){
        return $this->belongsTo(Student::class, 'student_affected', 'id');
    }

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'faculty_affected', 'id');
    }

}
