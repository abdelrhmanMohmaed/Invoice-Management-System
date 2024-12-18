<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-semibold text-gray-800">Add New Customer</h1>
                    </div>
                    <!-- start form -->
                    <form method="POST" action="{{ route('customers.store') }}" class="space-y-6">
                        @csrf
                        <!-- Customer Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Invoice
                                Number</label>
                            <input id="name" name="name" type="text"
                                value="{{ old('name') }}" @class([
                                    'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
                                    'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                                        'name'),
                                ])>
                            @error('name')
                                <small class="text-sm text-red-600 mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Customer Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Customer
                                Email</label>
                            <input id="email" name="email" type="text"
                                value="{{ old('email') }}" @class([
                                    'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
                                    'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                                        'email'),
                                ])>
                            @error('email')
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
