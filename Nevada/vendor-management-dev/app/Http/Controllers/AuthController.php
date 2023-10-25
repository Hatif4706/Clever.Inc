<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\SigninRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use ReCaptcha\ReCaptcha;

class AuthController extends Controller
{
    /**
     * Show signin form.
     */
    public function signin(): View
    {
        return view('auth.signin');
    }

    /**
     * Authenticate user credential.
     */
    public function authenticate(SigninRequest $request): RedirectResponse
    {
        $recaptcha = new ReCaptcha(config('recaptcha.secret'));
        $resp = $recaptcha->verify(
            $request['g-recaptcha-response'],
            $request->ip()
        );

        if (!$resp->isSuccess()) {
            return back()->with('failed', 'Recaptcha fail, are you a robot?');
        }

        if (Auth::attempt(
            $request->only('email', 'password'),
            $request->has('remember'))
        ) {
            $request->session()->regenerate();
            return redirect()->intended();
        }

        return back()->with('failed', 'Incorrect email/password');
    }

    /**
     * Show signup form.
     */
    public function signup(): View
    {
        return view('auth.signup');
    }

    /**
     * Signup a new user.
     */
    public function new(SignupRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        $user->assignRole('Vendor');

        foreach ($request->files as $file => $value) {
            if ($request->file($file)) {
                $validated[$file] = $request->file($file)
                    ->store("documents/vendors/$file");
            }
        }

        $validated['name'] = $validated['company_name'];
        $user->vendor()->create($validated);

        return redirect()->route('signin')
            ->with('success', 'Account created successfully');
    }

    /**
     * User signout.
     */
    public function signout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('signin')
            ->with('success', 'Signout successfully');
    }
}
