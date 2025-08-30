<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show login form
     */
    public function index()
    {
        return view('login.index');
    }

    /**
     * Attempt to login user
     */
    public function login(UserLoginRequest $request)
    {
        // Check validity
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        // Redirect back with error message
        return back()->withErrors([
            'username' => 'Username, email atau password salah'
        ]);
    }
}
