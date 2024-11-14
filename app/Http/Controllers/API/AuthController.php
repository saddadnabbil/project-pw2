<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator);
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
        ]);

        // Create a token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Send response with the token
        return $this->sendResponse(['token' => $token], 'User registered successfully');
    }

    /**
     * Login an existing user.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator);
        }

        // Attempt to authenticate user
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->sendError('Invalid login credentials', 401);
        }

        // If authentication is successful, generate a token
        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        // Send the token and user data in the response
        return $this->sendResponse(['token' => $token, 'user' => $user], 'User logged in successfully');
    }

    /**
     * Logout the authenticated user.
     */
    public function logout(Request $request)
    {
        // Delete all user tokens to log out
        $request->user()->tokens()->delete();

        return $this->sendResponse(null, 'User logged out successfully');
    }
}
