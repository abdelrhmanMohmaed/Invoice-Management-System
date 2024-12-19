<?php

namespace App\Http\Controllers\API\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Invoice\InvoiceStoreRequest;
use App\Http\Requests\Website\Invoice\InvoiceUpdateRequest;
use App\Models\Invoice;
use Exception;
use Response;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::paginate(10);

        return response()->customResponse(
            true,
            $invoices,
            'Invoices fetched successfully.',
            200,
            $invoices->total(),
            $invoices->nextPageUrl(),
            $invoices->previousPageUrl()
        );
    }
    public function show($id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->load(['createdBy', 'customer']);

            return Response::customResponse(
                true,
                $invoice,
                'Invoice retrieved successfully.'
            );
        } catch (Exception $e) {
            \Log::error('Invoice Show Unexpected Error: ' . $e->getMessage());
            return Response::errorResponse('Something went wrong. Please try again!', 500);
        }
    }
    public function store(InvoiceStoreRequest $request)
    {
        try {
            $this->authorize('create', Invoice::class);

            $validated               = $request->validated();
            $validated['created_by'] = auth()->id();

            $invoice = Invoice::create($validated);

            return Response::customResponse(
                true,
                $invoice,
                'Invoice created successfully.'
            );

        } catch (Exception $e) {
            \Log::error('Invoice Store Error: ' . $e->getMessage());
            return Response::errorResponse('Something went wrong. Please try again!', 500);
        }
    }
    public function update(InvoiceUpdateRequest $request, Invoice $invoice)
    {
        try {
            $this->authorize('update', $invoice);

            $validated               = $request->validated();
            $validated['updated_by'] = auth()->id();

            $invoice->update($validated);

            return Response::customResponse(
                true,
                $invoice,
                'Invoice updated successfully.'
            );
        } catch (Exception $e) {
            \Log::error('API Invoice Update Error: ' . $e->getMessage());
            return Response::errorResponse('Something went wrong. Please try again!');
        }
    }
    public function destroy(Invoice $invoice)
    {
        try {
            $this->authorize('delete', $invoice);

            $invoice->delete();

            return Response::customResponse(
                true,
                null,
                'Invoice deleted successfully.'
            );
        } catch (Exception $e) {
            \Log::error('API Invoice destroy Error: ' . $e->getMessage());
            return Response::errorResponse('Something went wrong. Please try again!');
        }
    }
}
