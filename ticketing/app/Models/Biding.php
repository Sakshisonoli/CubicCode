<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biding extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'ticket_id',
        'event_id',
        'bid_amt',
        'max_bid_amt',
        'status',
        'bid_time',
        'bid_number',
        'ticket_qty',
    ];

    public function customer(){

        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function ticket(){

        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    public function event(){

        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function order(){

        return $this->hasOne(Order::class, 'bid_id');
    }
}
