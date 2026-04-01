<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $eventName;
    public $deliveryType;
    public $totalPrice;
    public $seat;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $eventName, $deliveryType, $totalPrice, $seat)
    {
        $this->name = $name;
        $this->eventName = $eventName;
        $this->deliveryType = $deliveryType;
        $this->totalPrice = $totalPrice;
        $this->seat = $seat;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Order is Confirmed',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.order_confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->view('mails.order_confirmation')
            ->with([
            'name' => $this->name,
            'eventName' => $this->eventName,
            'deliveryType' => $this->deliveryType,
            'totalPrice' => $this->totalPrice,
            'seat' => $this->seat,
        ])
        ->subject('Your Order is Confirmed');
    }
}
