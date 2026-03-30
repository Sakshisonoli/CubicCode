<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'project_description',
        'project_doc',
        'points',
        'start_date',
        'end_date',
        'status',
        'send_to',
        'student_id',
        'branch_id',
        'batch_id',
        'course_id'
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function branch(){
        return $this->belongsTo(User::class, 'branch_id', 'id');
    }

    public function batch(){
        return $this->belongsTo(Batch::class, 'batch_id', 'id');
    }

    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function submission(){
        return $this->hasMany(Submission::class, 'assignment_id');
    }

}
