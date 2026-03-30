<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    use HasFactory;

    protected $fillable = [
        'stadium_name',
        'location',
        'image1',
        'image2',
        'image3',
        'image4',
        'status',
    ];

    public function event(){
        return $this->hasMany(Event::class, 'stadium_id');
    }

    public function seat(){
        return $this->hasMany(Seat::class, 'stadium_id');
    }
}
