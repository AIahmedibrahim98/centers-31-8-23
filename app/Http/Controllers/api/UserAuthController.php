<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8'
        ]);
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                // 'api_token' => Str::random(32),
            ]);
            $token = $user->createToken('user')->plainTextToken;
            return response()->json([
                'status' => 'user created',
                'user' => $user,
                'token' => $token
            ]);
        } catch (Exception $e) {
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);
        try {
            $user = User::firstWhere('email', $request->email);
            if ($user && Hash::check($request->password, $user->password)) {
                // $user->update(['api_token' => Str::random(32)]);
                return response()->json([
                    'status' => 'user login',
                    // 'api_token' => $user->api_token
                    'token' => $user->createToken('user')->plainTextToken,
                ]);
            } else {
                return response()->json([
                    'status' => 'user login Faild',
                    'message' => 'Password Does not math'
                ], 401);
            }
        } catch (Exception $e) {
        }
    }
}
