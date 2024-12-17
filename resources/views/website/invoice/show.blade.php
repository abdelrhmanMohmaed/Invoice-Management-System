<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-semibold text-gray-800">Show Invoice NO:
                            {{ $invoice->invoice_number }}</h1>
                        @can('update invoice')
                            <a href="{{ route('invoices.edit', $invoice->id) }}"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Edit</a>
                        @endcan
                    </div>
                    <!-- start form -->
                    <!-- Invoice Number -->
                    <div class="my-4">
                        <label for="invoice_number" class="block text-sm font-medium ">Invoice
                            Number</label>
                        <input id="invoice_number" name="invoice_number" type="text"
                            value="{{ $invoice->invoice_number }}" disabled
                            class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'>
                    </div>
                    <!-- Customer -->
                    <div class="my-4">
                        <label for="customer" class="block text-sm font-medium ">Customer Name</label>
                        <input id="customer" name="customer" type="text" value="{{ $invoice->customer->name }}"
                            disabled
                            class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'>
                    </div>
                    <!-- Amount -->
                    <div class="my-4">
                        <label for="amount" class="block text-sm font-medium ">Amount</label>
                        <input id="amount" name="amount" type="number" step="0.01" disabled
                            value="{{ $invoice->amount }}"
                            class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'>
                    </div>
                    <!-- Date -->
                    <div class="my-4">
                        <label for="date" class="block text-sm font-medium ">Date</label>
                        <input id="date" name="date" type="date" value="{{ $invoice->date }}" disabled
                            class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'>
                    </div>
                    <!-- Description -->
                    <div class="my-4">
                        <label for="description" class="block text-sm font-medium ">Description</label>
                        <textarea id="description" name="description" rows="3" disabled
                            class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'>{{ $invoice->description }}</textarea>
                    </div>
                    <!-- Currency -->
                    <div class="my-4">
                        <label for="currency" class="block text-sm font-medium ">Currency</label>
                        <select id="currency" name="currency" disabled
                            class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'>
                            <option value="EGP" @selected($invoice->currency == 'EGP')>EGP</option>
                            <option value="USD" @selected($invoice->currency == 'USD')>USD</option>
                        </select>
                    </div>
                    <!-- Payment Status -->
                    <div class="my-4">
                        <label for="payment_status" class="block text-sm font-medium">Payment
                            Status</label>
                        <select id="payment_status" name="payment_status" disabled
                            class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'>
                            <option value="pending" @selected($invoice->payment_status == 'pending')>Pending</option>
                            <option value="paid" @selected($invoice->payment_status == 'paid')>Paid</option>
                            <option value="partially_paid" @selected($invoice->payment_status == 'partially_paid')>Partially Paid</option>
                            <option value="failed" @selected($invoice->payment_status == 'failed')>Failed</option>
                            <option value="refunded" @selected($invoice->payment_status == 'refunded')>Refunded</option>
                            <option value="overdue" @selected($invoice->payment_status == 'overdue')>Overdue</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
