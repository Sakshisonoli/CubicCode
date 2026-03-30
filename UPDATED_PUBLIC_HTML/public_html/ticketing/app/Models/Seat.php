<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'stadium_id',
        'seat_level',
        'row',
        'number',
        'seat_type',
        'price',
    ];

    public function stadium(){

        return $this->belongsTo(Stadium::class, 'stadium_id', 'id');
    }

    public function ticket(){

        return $this->hasMany(Ticket::class, 'seat_id');
    }
}
