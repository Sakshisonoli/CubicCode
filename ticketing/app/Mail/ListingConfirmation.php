<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ListingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $eventName;
    public $seat;
    // public $tickets;
    public $price;
    public $eventDate;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $eventName, $seat, $price, $eventDate)
    {
        $this->name = $name;
        $this->eventName = $eventName;
        $this->seat = $seat;
        // $this->tickets = $tickets;
        $this->price = $price;
        $this->eventDate = $eventDate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Ticket Listing is Live',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.listing_confirmation',
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
        return $this->view('mails.listing_confirmation')
            ->with([
            'name' => $this->name,
            'eventName' => $this->eventName,
            'seat' => $this->seat,
            'price' => $this->price,
            'eventDate' => $this->eventDate,
        ])
        ->subject('Your Ticket Listing is Live');
    }
}
