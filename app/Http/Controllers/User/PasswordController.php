<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\PasswordChangeRequest;

class PasswordController extends Controller
{
    /**
     * Display a form for input email.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function request()
    {
        return view('auth.email');
    }

    /**
     * Send reset link on email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function email(Request $request)
    {
        $email = $request->validate(['email'=>'required|email']);

        $status = Password::sendResetLink($email);

        return $status === Password::RESET_LINK_SENT ?
            back()->with([
                'status'  => 'ok',
                'message' => __($status),
            ]) : back()->withInput()->with([
                'status'  => 'error',
                'message' => __($status),
            ]);
    }

    /**
     * Display a form for reset password.
     *
     * @param  string  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function reset($token)
    {
        return view('auth.password', compact('token'));
    }

    /**
     * Reset password.
     *
     * @param  \App\Http\Requests\PasswordResetRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PasswordResetRequest $request)
    {
        $validated = $request->validated();

        $status = Password::reset($validated, 
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET ?
            redirect()->route('login.index')->with([
                'status'  => 'ok',
                'message' => __($status),
            ])
            : back()->withInput()->with([
                'status'  => 'error',
                'message' => __($status),
            ]);
    }

    /**
     * Display a form for change password.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function change()
    {
        return view('auth.change');
    }

    /**
     * Change password.
     *
     * @param  \App\Http\Requests\PasswordChangeRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function new(PasswordChangeRequest $request)
    {
        $password = $request->safe()->only('password_new');
        
        $user = $request->user();
        $user->password = Hash::make($password['password_new']);
        $user->save();

        return redirect()->route('users.edit', ['user'=>$user->id])->with([
            'status'  => 'ok',
            'message' => 'Password was changed successfully',
        ]);
    }
}
