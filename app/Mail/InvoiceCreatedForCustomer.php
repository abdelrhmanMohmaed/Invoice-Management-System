<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceCreatedForCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $action;

    /**
     * Create a new message instance.
     */
    public function __construct($invoice, string $action)
    {
        $this->invoice = $invoice;
        $this->action  = $action;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('no-reply@methode.com', 'Invoice System'),
            subject: 'Invoice ' . $this->action . " successfully",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'website.emails.user',  // اسم الـ View
            with: [
                'invoice' => $this->invoice, // تمرير المتغير invoice
                'action' => $this->action,  // تمرير المتغير action
            ]
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
}
