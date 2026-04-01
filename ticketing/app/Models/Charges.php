<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charges extends Model
{
    use HasFactory;

    protected $fillable = [
        'min_amt',
        'max_amt',
        'charges',
        'note',
        'category',
        'count',
        'status',
    ];
}
