<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\SendResetLinkRequest;
use App\Http\Requests\Auth\NewPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    /**
     * Show forgot password form.
     */
    public function forgot(): View
    {
        return view('auth.forgot');
    }

    /**
     * Show reset password form.
     */
    public function reset(): View
    {
        return view('auth.reset');
    }

    /**
     * Send reset password link to email.
     */
    public function send(SendResetLinkRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', "Email sent to {$request->email}")
            : back()->with(['email' => __($status)])->withInput();
    }

    /**
     * Reset old password to new password.
     */
    public function new(NewPasswordRequest $request): RedirectResponse
    {
        try {
            $request['email'] = Crypt::decryptString($request->email);
        } catch (DecryptException) {
            return back()->withErrors(['email' => 'Invalid email']);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('signin')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
