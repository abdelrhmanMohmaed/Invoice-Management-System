<?php

namespace App\Http\Requests\Website\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $invoice = $this->route('invoice');
        
        return [
            'invoice_number' => 'required|string|unique:invoices,invoice_number,' . $invoice->id,
            'customer_id' => 'required|string|exists:customers,id',
            'amount' => 'required|numeric',
            'date' => 'required|date|date_format:Y-m-d',
            'description' => 'required|string',
            'currency' => 'required|in:EGP,USD',
            'payment_status' => 'required|in:pending,paid,partially_paid,failed,refunded,overdue',
        ];
    }
    public function messages(): array
    {
        return [
            'customer_id.exists' => 'The selected customer does not exist in our records.',
        ];
    }
}
