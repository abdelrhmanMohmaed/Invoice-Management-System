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
    public $changes;

    /**
     * Create a new job instance.
     */
    public function __construct($invoice, $action, $changes = null)
    {
        $this->invoice = $invoice;
        $this->action  = $action;
        $this->changes  = $changes;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->action == 'update' && !$this->changes) {
            Log::warning("No changes detected for Invoice ID: {$this->invoice->id}");
            return;
        }
    
        Mail::to($this->invoice->createdBy->email)->send(
            new InvoiceCreatedForUser($this->invoice, $this->action, $this->changes)
        );
    
        Mail::to($this->invoice->customer->email)->send(
            new InvoiceCreatedForCustomer($this->invoice, $this->action, $this->changes)
        );
    }
    public function failed(\Exception $exception): void
    {
        Log::error("Failed to send invoice emails for Invoice ID: {$this->invoice->id}");
        Log::error("Error Message: " . $exception->getMessage());
    }
}
