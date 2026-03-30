<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'project_name',
        'desciption',
        'file',
        'marks',
        'project_note',
        'branch_id',
        'status',
        'assignment_id'
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function branch(){
        return $this->belongsTo(User::class, 'branch_id', 'id');
    }

    public function assignment(){
        return $this->belongsTo(Assignment::class, 'assignment_id', 'id');
    }

}
