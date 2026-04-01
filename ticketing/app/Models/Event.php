<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'artist_name',
        'description',
        'event_date',
        'event_time',
        'event_location',
        'stadium_id',
        'event_stadium',
        'event_photo',
        'status',
        'feature_status',
        'demo',
        'crowd_status',
        'addition',
        'category',
        'view_ids',
    ];

    public function stadium(){

        return $this->belongsTo(Stadium::class, 'stadium_id', 'id');
    }

    public function ticket(){

        return $this->hasMany(Ticket::class, 'event_id');
    }

    public function Biding(){

        return $this->hasMany(Biding::class, 'event_id');
    }
}
