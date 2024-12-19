<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\User\UserStoreRequest;
use App\Http\Requests\Website\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderByDesc('id')->paginate(10);

        return view('website.users.index', compact('users'));
    }
    public function show(User $user): View
    {
        return view('website.users.show', compact('user'));
    }
    public function create(): View
    {
        $roles       = Role::orderByDesc('id')->get();
        $permissions = Permission::orderByDesc('id')->get();

        return view('website.users.create', compact('roles', 'permissions'));
    }
    public function store(UserStoreRequest $request): RedirectResponse
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            if ($request->has('roles')) {
                $user->assignRole($request->roles);
            }

            if ($request->has('permissions')) {
                $user->givePermissionTo($request->permissions);
            }

            return redirect()->route('users.index')->with('success', 'User created successfully!');
        } catch (Exception $e) {
            \Log::error('User Store Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again!');
        }
    }
    public function edit(User $user): View
    {
        $roles       = Role::orderByDesc('id')->get();
        $permissions = Permission::orderByDesc('id')->get();

        return view('website.users.edit', compact('user', 'roles', 'permissions'));
    }
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->has('password') ? $request->password : $user->password,
            ]);

            if ($request->has('roles')) {
                $user->syncRoles($request->roles);
            }

            if ($request->has('permissions')) {
                $user->syncPermissions($request->permissions);
            }

            return redirect()->route('users.index')->with('success', 'User updated successfully!');
        } catch (Exception $e) {
            \Log::error('User Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again!');
        }
    }
    public function destroy(User $user): RedirectResponse
    {
        try {

            $user->delete();

            return redirect()->route('users.index')->with('success', 'User deleted successfully!');
        } catch (Exception $e) {
            \Log::error('User destroy Error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong. Please try again!');
        }
    }
}
