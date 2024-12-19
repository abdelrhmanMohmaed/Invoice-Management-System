<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\User\UserStoreRequest;
use App\Http\Requests\Website\User\UserUpdateRequest;
use App\Models\User;
use Exception;
use Response;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        return response()->customResponse(
            true,
            $users,
            'Users fetched successfully.',
            200,
            $users->total(),
            $users->nextPageUrl(),
            $users->previousPageUrl()
        );
    }
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);

            return Response::customResponse(
                true,
                $user,
                'User retrieved successfully.'
            );
        } catch (Exception $e) {
            \Log::error('User Show Unexpected Error: ' . $e->getMessage());
            return Response::errorResponse('Something went wrong. Please try again!', 500);
        }
    }
    public function store(UserStoreRequest $request)
    {
        try {
            $this->authorize('create', User::class);

            $validated = $request->validated();

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $request->password,
            ]);

            if ($request->has('roles')) {
                $user->assignRole($validated['roles']);
            }

            if ($request->has('permissions')) {
                $user->givePermissionTo($validated['permissions']);
            }

            return Response::customResponse(
                true,
                $user,
                'User created successfully.'
            );
        } catch (Exception $e) {
            \Log::error('User Store Error: ' . $e->getMessage());
            return Response::errorResponse('Something went wrong. Please try again!', 500);
        }
    }
    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            $this->authorize('update', $user);

            $validated = $request->validated();

            $user->update([
                'name' => $validated['name'] ?? $user->name,
                'email' => $validated['email'] ?? $user->email,
                'password' => isset($validated['password']) ? $validated['password'] : $user->password,
            ]);

            if ($request->has('roles')) {
                $user->syncRoles($validated['roles']);
            }

            if ($request->has('permissions')) {
                $user->syncPermissions($validated['permissions']);
            }

            return Response::customResponse(
                true,
                $user,
                'User updated successfully.'
            );
        } catch (Exception $e) {
            \Log::error('User Update Error: ' . $e->getMessage());
            return Response::errorResponse('Something went wrong. Please try again!', 500);
        }
    }
    public function destroy(User $user)
    {
        try {
            $this->authorize('delete', $user);

            $user->delete();

            return Response::customResponse(
                true,
                null,
                'User deleted successfully.'
            );
        } catch (Exception $e) {
            \Log::error('API User destroy Error: ' . $e->getMessage());
            return Response::errorResponse('Something went wrong. Please try again!');
        }
    }
}
