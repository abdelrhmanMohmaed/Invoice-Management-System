<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-semibold text-gray-800">Customers</h1>
                        @can('create customer')
                            <a href="{{ route('customers.create') }}"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Add Customers
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="py-6 px-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b text-left text-gray-600">#</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600">Customer Name</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600">Email</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $item)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                                        <td class="py-2 px-4 border-b">{{ $item->name }}</td>
                                        <td class="py-2 px-4 border-b">{{ $item->email }}</td>


                                        <td class="py-2 px-4 border-b">

                                            @can('show customer')
                                                <a href="{{ route('customers.show', $item->id) }}"
                                                    class="text-gray-500 hover:text-gray-700">Show</a>
                                            @endcan

                                            @can('update customer')
                                                <a href="{{ route('customers.edit', $item->id) }}"
                                                    class="text-blue-500 hover:text-blue-700">Edit</a>
                                            @endcan

                                            @can('delete customer')
                                                <form method="POST" action="{{ route('customers.destroy', $item->id) }}"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="text-red-500 hover:text-red-700"
                                                        onclick="return confirm('Are you sure to delete this term')">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-2 px-4 border-b">-</td>
                                        <td class="py-2 px-4 border-b">-</td>
                                        <td class="py-2 px-4 border-b">
                                            <button class="text-blue-500 hover:text-blue-700">-</button>
                                            <button class="text-red-500 hover:text-red-700">-</button>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="py-6 px-4 bg-white text-gray-700">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
