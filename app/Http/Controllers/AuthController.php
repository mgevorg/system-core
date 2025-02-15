<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Services\AuthService\Sample;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        // dd(321);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return response()->json(['message' => 'User registered successfully.'], 201);
    }

    /**
     * Log in the user and issue an access token.
     */
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($validatedData)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('SystemCore')->accessToken;

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer', 'expires_in' => 3600]);
    }

    /**
     * Log out the authenticated user.
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke(); // Revoke the user's access token
        return response()->json(['message' => 'Logged out successfully.']);
    }

    /**
     * Get the authenticated user.
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function check(Request $request)
    {
        if(!isset($request['TransactID'])) {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://ucrm.getnet.am/crm/_plugins/easypay-payment-gateway/public.php', ($request->all()));
            $decodedResponse = json_decode($response->body(), true);
            return response()->json($decodedResponse, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json ('Unprocessable content', 422);
        }
    }
    public function payment(Request $request)
    {
        if(isset($request['TransactID'])) {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://ucrm.getnet.am/crm/_plugins/easypay-payment-gateway/public.php', ($request->all()));
            $decodedResponse = json_decode($response->body(), true);
            return response()->json($decodedResponse, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json ('Unprocessable content', 422);
        }
    }

    public function md(Request $request)
    {
        $data = $request['field'];
        // dd($request->ip());
        dd(md5($data));
        return 0;
    }
}