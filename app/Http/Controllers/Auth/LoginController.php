<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a form for login.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Login.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $user = $request->safe()->merge([
            'is_active' => true,
        ])->except(['remember']);
        
        $remember = $request->safe()->only(['remember']) ?: false;

        if (! Auth::attempt($user, $remember)) {
            return back()->with([
                'status'  => 'error',
                'message' => 'Email or Password is invalid',
            ])->withInput();
        }

        $request->session()->regenerate();

        return redirect()->route('users.edit', ['user'=>Auth::id()]);
    }

    /**
     * Logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.login');
    }
}
