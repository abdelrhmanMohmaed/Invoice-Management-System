<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-semibold text-gray-800">Show Customer :
                            {{ $customer->name }}</h1>
                        @can('update customer')
                            <a href="{{ route('customers.edit', $customer->id) }}"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Edit</a>
                        @endcan
                    </div>

                    <!-- Customer -->
                    <div class="my-4">
                        <label for="customer" class="block text-sm font-medium ">Customer Name</label>
                        <input id="customer" name="customer" type="text" value="{{ $customer->name }}" disabled
                            class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'>
                    </div>
                    <!-- Customer Email -->
                    <div class="my-4">
                        <label for="customer_email" class="block text-sm font-medium ">Invoice
                            Number</label>
                        <input id="customer_email" name="customer_email" type="email" value="{{ $customer->email }}"
                            disabled
                            class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
