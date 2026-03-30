<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_id',
        'ticket_id',
        'bid_id',
        'ticket_price',
        'no_of_tickets',
        'total_price',
        'gst',
        'discount',
        'mode',
        'payment_id',
        'status',
        'note',
    ];

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function ticket(){
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    public function bid(){
        return $this->belongsTo(Biding::class, 'bid_id', 'id');
    }
}
