<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'batch_id',
        'date',
        'status',
        'branch_id',
        'comment'
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function batch(){
        return $this->belongsTo(Batch::class, 'batch_id', 'id');
    }

    public function branch(){
        return $this->belongsTo(User::class, 'branch_id', 'id');
    }
}
