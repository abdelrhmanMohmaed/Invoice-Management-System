<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if ($user->hasRole('Admin')) {
                $token = $user->createToken('AdminToken')->plainTextToken;
                return Response::customResponse(
                    true,
                    [
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => 'Admin',
                        'token' => $token,
                    ],
                    'Login successful as Admin'
                );
            } elseif ($user->hasRole('Employee')) {
                $token = $user->createToken('EmployeeToken')->plainTextToken;
                return Response::customResponse(
                    true,
                    [
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => 'Employee',
                        'token' => $token,
                    ],
                    'Login successful as Employee'
                );
            } else {
                return Response::errorResponse('Unauthorized role', 403);
            }
        }

        return Response::errorResponse('Invalid credentials', 401);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $user->tokens()->delete();

            return Response::successResponse('Logged out successfully.');
        }

        return Response::errorResponse('User not authenticated.', 401);
    }
}
