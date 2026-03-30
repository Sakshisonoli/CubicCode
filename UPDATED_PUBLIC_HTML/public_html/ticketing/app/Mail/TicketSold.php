<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketSold extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $eventName;
    public $buyerName;
    public $deliveryType;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $eventName, $buyerName, $deliveryType)
    {
        $this->name = $name;
        $this->eventName = $eventName;
        $this->buyerName = $buyerName;
        $this->deliveryType = $deliveryType;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You have Sold a Ticket!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.ticket_sold',
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
        return $this->view('mails.ticket_sold')
            ->with([
            'name' => $this->name,
            'eventName' => $this->eventName,
            'buyerName' => $this->buyerName,
            'deliveryType' => $this->deliveryType,
        ])
        ->subject('You have Sold a Ticket!');
    }
}
