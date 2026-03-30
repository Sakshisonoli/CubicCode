<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymentsinfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'banck_name',
        'ac_holder_name',
        'acc_number',
        'bank_branch',
        'ifsc_code',
        'address',
        'city',
        'state',
        'post_code',
        'status',
    ];

    public function customer(){

        return $this->belongsTo(Paymentsinfo::class, 'customer_id', 'id');
    }
}
