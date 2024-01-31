<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * authenticate
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(
                [
                    'result' => self::API_RESULT_OK,
                ]
            );
        }

        return response()->json(
            [
                'result' => self::API_RESULT_NG,
            ]
            , Response::HTTP_UNAUTHORIZED
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(LoginRequest $request)
    {
        // Insert
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // response
        return response()->json(
            [
                'result' => self::API_RESULT_OK,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // response
        return response()->json(
            [
                'result' => self::API_RESULT_OK,
            ]
        );
    }
}
