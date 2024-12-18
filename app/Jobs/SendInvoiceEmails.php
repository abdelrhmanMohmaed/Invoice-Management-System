<?php

namespace App\Jobs;

use App\Mail\InvoiceCreatedForCustomer;
use App\Mail\InvoiceCreatedForUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Log;

class SendInvoiceEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $invoice;
    public $action;

    /**
     * Create a new job instance.
     */
    public function __construct($invoice, $action)
    {
        $this->invoice = $invoice;
        $this->action  = $action;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->invoice->createdBy->email)->send(new InvoiceCreatedForUser($this->invoice, $this->action));
        Mail::to($this->invoice->customer->email)->send(new InvoiceCreatedForCustomer($this->invoice, $this->action));
    }

    public function failed(\Exception $exception): void
    {
        Log::error("Failed to send invoice emails for Invoice ID: {$this->invoice->id}");
        Log::error("Error Message: " . $exception->getMessage());
    }
}
