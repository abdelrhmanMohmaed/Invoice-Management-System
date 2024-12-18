<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Invoice\InvoiceStoreRequest;
use App\Http\Requests\Website\Invoice\InvoiceUpdateRequest;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\View\View;
use App\Events\InvoiceActionPerformed;


class InvoiceController extends Controller
{
    public function index(): View
    {
        $invoices = Invoice::with(['createdBy', 'customer'])->orderByDesc('id')->paginate(10);

        return view('website.invoice.index', compact('invoices'));
    }
    public function show(Invoice $invoice): View
    {
        $invoice->load(['createdBy','customer']);

        return view('website.invoice.show', compact('invoice'));
    }
    public function create(): View
    {
        $customers = Customer::get();

        return view('website.invoice.create', compact('customers'));
    }
    public function store(InvoiceStoreRequest $request): RedirectResponse
    {
        try {
            $validated               = $request->validated();
            $validated['created_by'] = auth()->id();
            $invoice                 = Invoice::create($validated);

            event(new InvoiceActionPerformed($invoice, 'create', auth()->user(), auth()->user()->getRoleNames()->first()));

            return redirect()->route('invoices.index')->with('success', 'Invoice created successfully!');
        } catch (Exception $e) {
            \Log::error('Invoice Store Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again!');
        }
    }
    public function edit(Invoice $invoice): View
    {
        $invoice->load(['createdBy']);
        $customers = Customer::get();

        return view('website.Invoice.edit', compact('invoice', 'customers'));
    }
    public function update(InvoiceUpdateRequest $request, Invoice $invoice): RedirectResponse
    {
        try {
            $validated = $request->validated();

            $invoice->update([
                'invoice_number' => $validated['invoice_number'],
                'customer_id' => $validated['customer_id'],
                'amount' => $validated['amount'],
                'date' => $validated['date'],
                'description' => $validated['description'],
                'currency' => $validated['currency'],
                'payment_status' => $validated['payment_status']
            ]);

            event(new InvoiceActionPerformed($invoice, 'update', auth()->user(), auth()->user()->getRoleNames()->first()));

            return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully!');
        } catch (Exception $e) {
            \Log::error('Invoice Update Error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong. Please try again!');
        }
    }
    public function destroy(Invoice $invoice): RedirectResponse
    {
        try {

            $invoice->delete();
            event(new InvoiceActionPerformed($invoice, 'delete', auth()->user(), auth()->user()->getRoleNames()->first()));

            return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully!');
        } catch (Exception $e) {
            \Log::error('Invoice destroy Error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong. Please try again!');
        }
    }
}
