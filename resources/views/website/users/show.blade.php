<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-semibold text-gray-800">Show User :
                            {{ $user->name }}</h1>
                        @can('update user')
                            <a href="{{ route('users.edit', $user->id) }}"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Edit</a>
                        @endcan
                    </div>

                    <!-- User -->
                    <div class="my-4">
                        <label for="user" class="block text-sm font-medium ">User Name</label>
                        <input id="user" name="user" type="text" value="{{ $user->name }}" disabled
                            class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'>
                    </div>
                    <!-- User Email -->
                    <div class="my-4">
                        <label for="email" class="block text-sm font-medium ">Email</label>
                        <input id="email" name="email" type="email" value="{{ $user->email }}" disabled
                            class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'>
                    </div>
                    <!-- User Roles -->
                    <div class="my-4">
                        <label for="roles" class="block text-sm font-medium">Roles</label>
                        <input id="roles" name="roles" type="text"
                            value="{{ $user->getRoleNames()->implode(', ') }}" disabled
                            class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'>
                    </div>
                    <!-- User Permissions -->
                    <div class="my-4">
                        <label for="permission" class="block text-sm font-medium">Permission</label>
                        <input id="permission" name="permission" type="text"
                            value="{{ $user->getPermissionNames()->implode(', ') }}" disabled
                            class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
