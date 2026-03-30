<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'gender',
        'enquiry_date',
        'course_enquiry',
        'city',
        'education',
        'branch_name',
        'branch_id',
        'interest_level',
        'followup_status',
        'followup_action',
        'followup_date',
        'followup_time',
        'last_followup',
        'followups_count',
        'seller_name',
        'seller_id',
        'note',
        'status'
    ];

    public function seller(){
        return $this->belongsTo(Faculty::class, 'seller_id', 'id');
    }

    public function branch(){
        return $this->belongsTo(User::class, 'branch_id', 'id');
    }
}
