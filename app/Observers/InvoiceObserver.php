<?php

namespace App\Observers;

use App\Jobs\SendInvoiceEmails;
use App\Models\Invoice;
use App\Models\LogBook;
use App\Models\User;

class InvoiceObserver
{
    /**
     * Handle the Invoice "created" event.
     */
    public function created(Invoice $invoice): void
    {
        $user = auth()->guard('api')->user() ?? auth()->user();

        LogBook::create([
            'invoice_id' => $invoice->id,
            'action_taken' => 'create',
            'created_by' => $user->id,
            'user_role' => $user->getRoleNames()->first(),
        ]);

        SendInvoiceEmails::dispatch($invoice, 'create');
    }

    /**
     * Handle the Invoice "updated" event.
     */
    public function updated(Invoice $invoice): void
    {
        $user    = auth()->guard('api')->user() ?? auth()->user();
        $changes = $invoice->getChanges();

        LogBook::create([
            'invoice_id' => $invoice->id,
            'action_taken' => 'update',
            'created_by' => $user->id,
            'user_role' => $user->getRoleNames()->first(),
        ]);

        SendInvoiceEmails::dispatch($invoice, 'update', $changes);
    }


    /**
     * Handle the Invoice "deleted" event.
     */
    public function deleted(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "restored" event.
     */
    public function restored(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "force deleted" event.
     */
    public function forceDeleted(Invoice $invoice): void
    {
        //
    }
}
