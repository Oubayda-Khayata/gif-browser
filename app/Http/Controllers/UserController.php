<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Login for user.
     * @param LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request) {
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = Auth::user();
            return json('success', ['Logged in successfully'], [
                'user' => $user,
                'token' => $user->createToken('Access Token')->accessToken
            ]);
        }

        return json('error', ['Invalid email or password'], '', 401);
    }

    /**
     * Logout for user.
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request) {
        $user = Auth::user();
        $user->token()->revoke();
        return json('success', ['Logged out successfully for current device'], ['user' => $user]);
    }

    /**
     * Signup for user.
     * @param SignupRequest $request
     * @return mixed
     */
    public function signup(SignupRequest $request) {
        $user = User::create($request->validated());
        $user->password = Hash::make($user->password);
        $user->save();

        return json('success', ['Signed up successfully'], [
            'user' => $user,
            'token' => $user->createToken('Access Token')->accessToken
        ]);
    }
}
