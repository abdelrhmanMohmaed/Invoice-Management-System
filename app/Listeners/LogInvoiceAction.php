<?php

namespace App\Listeners;

use App\Events\InvoiceActionPerformed;
use App\Models\LogBook;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogInvoiceAction
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(InvoiceActionPerformed $event): void
    {
        LogBook::create([
            'invoice_id' => $event->invoice->id,
            'action_taken' => $event->action,
            'created_by' => $event->user->id,
            'user_role' => $event->role,
        ]);
    }
}
