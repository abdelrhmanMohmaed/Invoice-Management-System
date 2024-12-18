<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-semibold text-gray-800">Edit User</h1>
                    </div>

                    <!-- start form -->
                    <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        <!-- Users Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">User Name</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                                @class([
                                    'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
                                    'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                                        'name'),
                                ])>
                            @error('name')
                                <small class="text-sm text-red-600 mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Users Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">User Email</label>
                            <input id="email" name="email" type="text" value="{{ old('email', $user->email) }}"
                                @class([
                                    'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
                                    'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                                        'email'),
                                ])>
                            @error('email')
                                <small class="text-sm text-red-600 mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password  -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password (Leave blank
                                to keep the same)</label>
                            <input id="password" name="password" type="password"
                                class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'>
                            @error('password')
                                <small class="text-sm text-red-600 mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                                Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'>
                            @error('password_confirmation')
                                <small class="text-sm text-red-600 mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- User Roles -->
                        <div>
                            <label for="roles" class="block text-sm font-medium text-gray-700">Roles</label>
                            <select name="roles[]" id="roles" multiple
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach ($roles as $item)
                                    <option value="{{ $item->name }}"
                                        {{ in_array($item->name, old('roles', $user->roles->pluck('name')->toArray())) ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('roles')
                                <small class="text-sm text-red-600 mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- User Permissions -->
                        <div>
                            <label for="permissions" class="block text-sm font-medium text-gray-700">Permissions</label>
                            <select name="permissions[]" id="permissions" multiple
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach ($permissions as $item)
                                    <option value="{{ $item->name }}"
                                        {{ in_array($item->name, old('permissions', $user->permissions->pluck('name')->toArray())) ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('permissions')
                                <small class="text-sm text-red-600 mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Save Changes
                            </button>
                        </div>
                    </form>
                    <!-- end form -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
