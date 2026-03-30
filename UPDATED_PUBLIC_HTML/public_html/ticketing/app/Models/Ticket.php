<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_name',
        'event_id',
        'seat_id',
        'number_of_tickets',
        'seat_numbers',
        'min_price',
        'max_price',
        'total_min_price',
        'total_max_price',
        'sell_type',
        'features',
        'comments',
        'restrictions',
        'limitations',
        'owner_id',
        'purchaser_id',
        'biding_status',
        'min_bid_price',
        'max_bid_price',
        'payment_status',
        'download_status',
        'ticket_image1',
        'ticket_image2',
        'status',
        'rating',
        'about_you',
        'listing_type',
        'delivery_type',
        'about_ticket',
        't_and_c_status',
        'reason',
        'paid_status',
        'paid_date',
        'paid_amount',
        'charges',
    ];

    protected $casts = [
        'seat_numbers' => 'array',
    ];

    public function event(){

        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function seat(){

        return $this->belongsTo(Seat::class, 'seat_id', 'id');
    }

    public function  owner(){

        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function purchaser(){

        return $this->belongsTo(User::class, 'purchaser_id', 'id');
    }

    public function biding(){

        return $this->hasMany(Biding::class, 'event_id');
    }

    public function order(){

        return $this->hasMany(Order::class, 'ticket_id');
    }
}
