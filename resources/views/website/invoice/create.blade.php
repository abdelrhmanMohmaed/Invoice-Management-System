<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-semibold text-gray-800">Add New Invoice</h1>
                    </div>
                    <!-- start form -->
                    <form method="POST" action="{{ route('invoices.store') }}" class="space-y-6">
                        @csrf
                        <!-- Invoice Number -->
                        <div>
                            <label for="invoice_number" class="block text-sm font-medium text-gray-700">Invoice
                                Number</label>
                            <input id="invoice_number" name="invoice_number" type="text"
                                value="{{ old('invoice_number') }}" @class([
                                    'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
                                    'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                                        'invoice_number'),
                                ])>
                            @error('invoice_number')
                                <small class="text-sm text-red-600 mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Customer Name -->
                        <div>
                            <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer
                                Name</label>
                            <select id="customer_id" name="customer_id" @class([
                                'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
                                'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                                    'customer_id'),
                            ])>
                                <option disabled selected>Open this menu</option>
                                @forelse ($customers as $item)
                                    <option value="{{ $item->id }}" @selected(old('customer_id') == $item->id)>
                                        {{ $item->name }}
                                    </option>
                                @empty
                                    <option>No Data</option>
                                @endforelse
                            </select>

                            @error('customer_id')
                                <small class="text-sm text-red-600 mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Amount -->
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                            <input id="amount" name="amount" type="number" step="0.01"
                                value="{{ old('amount') }}" @class([
                                    'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
                                    'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                                        'amount'),
                                ])>
                            @error('amount')
                                <small class="text-sm text-red-600 mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Date -->
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                            <input id="date" name="date" type="date" value="{{ old('date') }}"
                                @class([
                                    'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
                                    'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                                        'date'),
                                ])>
                            @error('date')
                                <small class="text-sm text-red-600 mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" rows="3" @class([
                                'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
                                'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                                    'description'),
                            ])>{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-sm text-red-600 mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Currency -->
                        <div>
                            <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                            <select id="currency" name="currency" @class([
                                'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
                                'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                                    'currency'),
                            ])>
                                <option value="EGP" @selected(old('currency') == 'EGP')>EGP</option>
                                <option value="USD" @selected(old('currency') == 'USD')>USD</option>
                            </select>
                            @error('currency')
                                <small class="text-sm text-red-600 mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Payment Status -->
                        <div>
                            <label for="payment_status" class="block text-sm font-medium text-gray-700">Payment
                                Status</label>
                            <select id="payment_status" name="payment_status" @class([
                                'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
                                'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                                    'payment_status'),
                            ])>
                                <option value="pending" @selected(old('payment_status') == 'pending')>Pending</option>
                                <option value="paid" @selected(old('payment_status') == 'paid')>Paid</option>
                                <option value="partially_paid" @selected(old('payment_status') == 'partially_paid')>Partially Paid</option>
                                <option value="failed" @selected(old('payment_status') == 'failed')>Failed</option>
                                <option value="refunded" @selected(old('payment_status') == 'refunded')>Refunded</option>
                                <option value="overdue" @selected(old('payment_status') == 'overdue')>Overdue</option>
                            </select>
                            @error('payment_status')
                                <small class="text-sm text-red-600 mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Save Invoice
                            </button>
                        </div>
                    </form>
                    <!-- end form -->
                </div>
            </div>
        </div>
</x-app-layout>
