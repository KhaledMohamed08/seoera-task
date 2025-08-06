<?php

namespace App\Http\Controllers\Api\Auth;

use App\helpers\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15|unique:users|regex:/^(\+?[0-9]{1,3})?[0-9]{10}$/', // Example regex for international phone numbers
            'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::defaults()],
        ], [
            'phone.regex' => 'The phone number format is invalid.',
        ]);

        $this->store($request);

        return ApiResponse::success(null, 'User registered successfully', 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (! $token = auth('api')->attempt($credentials)) {
            return ApiResponse::error('Unauthorized', 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        return $this->handleJwtOperation(function () {
            auth('api')->logout();
            return ApiResponse::success(null, 'User logged out successfully');
        }, 'Failed to log out');
    }

    public function refresh()
    {
        return $this->handleJwtOperation(function () {
            $token = auth('api')->refresh();
            return $this->respondWithToken($token);
        }, 'Failed to refresh token');
    }

    private function store(Request $request)
    {
        return User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $request->password,
            'type' => $request->type,
        ]);
    }

    private function respondWithToken($token)
    {
        return ApiResponse::success(
            [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60,
            ],
            'Login successful'
        );
    }

    private function handleJwtOperation(callable $operation, string $errorMessage)
    {
        try {
            return $operation();
        } catch (JWTException $e) {
            return ApiResponse::error("$errorMessage ({$e->getMessage()})", 500);
        }
    }
}
