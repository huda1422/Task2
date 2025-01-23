<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {

            $admin = Auth::guard('admin')->user();
            $token = $admin->createToken('admin-token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful.',
                'token' => $token,
            ]);
        }

        return response()->json(['message' => 'Invalid credentials.'], 401);
    }

    public function profile()
    {
        return response()->json(Auth::guard('admin')->user());
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logout successful.']);
    }
}
