<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'student_id',
        'course_id',
        'payment_type',
        'payment_mode',
        'course_amount',
        'amount_paid',
        'amount_due',
        'total_installments',
        'installment_count',
        'installment_date',
        'next_installment_date',
        'next_installment_amount',
        'ins_status',
        'payment_status',
        'service_charge',
        'paid_to_branch',
        'branch_id',
        'note'
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function branch(){
        return $this->belongsTo(User::class, 'branch_id', 'id');
    }
}
