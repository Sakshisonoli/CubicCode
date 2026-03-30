<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
        'duration',
        'fees',
        'doc_link',
        'teaching_mode',
        'max_fees',
        'tech_fees_payable',
        'tech_fees_percentage',
        'status',
        'cid',
        'note'
    ];

    public function Batch(){
        return $this->hasMany(Batch::class, 'course_id');
    }

    public function student(){
        return $this->hasMany(Student::class, 'course_id');
    }

    public function fees(){
        return $this->hasMany(Fees::class, 'course_id');
    }

    public function assignment(){
        return $this->hasMany(Assignment::class, 'course_id');
    }

}
