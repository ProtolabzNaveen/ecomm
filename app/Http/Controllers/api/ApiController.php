<?php
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    // Register
    public function register(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }
   
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // Login
    public function login(Request $request)
    {
        // Validate the request
        $credentials = $request->only('email', 'password');

        // Check if authentication is successful
        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
          $user = Auth::user();
        // Generate JWT token for the authenticated user
        $token = JWTAuth::fromUser($user);

        // Return the token in the response
        return response()->json([
            'token' => $token,
        ]);
    }

    // Get Authenticated User
    public function users()
    {
        $users = User::all()->toArray();
        return response()->json($users);
    }
    public function user($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
}
