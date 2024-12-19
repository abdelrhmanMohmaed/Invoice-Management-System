<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceCreatedForUser extends Mailable
{
    use Queueable, SerializesModels;

    public $action;
    public $invoice;
    public $changes;

    /**
     * Create a new message instance.
     */
    public function __construct($invoice, string $action, $changes = null)
    {
        $this->action  = $action;
        $this->invoice = $invoice;
        $this->changes = $changes;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('no-reply@methode.com', 'Invoice System'),
            subject: 'Invoice ' . $this->action . " Successfully",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'website.emails.user',
            with: [
                'action'  => $this->action,
                'invoice' => $this->invoice,
                'changes' => $this->changes,
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
