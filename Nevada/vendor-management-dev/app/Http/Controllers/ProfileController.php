<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index() {
        return view('dashboard.profile.index');
    }

    public function vendor() {
        $vendor = Auth::user()->vendor;
        return view('dashboard.profile.vendor', ['vendor' => $vendor]);
    }

    public function password() {
        return view('dashboard.profile.password');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'profile_picture' => 'image|mimes:jpg,jpeg,png|max:2048',
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'phone_number' => [
                'required', 'numeric' ,'max_digits:255',
                Rule::unique('users')->ignore($user->id)
            ],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        if ($request->hasFile('profile_picture'))
            $user['profile_picture'] = $request->file('profile_picture')
                ->store('public');

        $user->save();

        return back()->with('success', 'Profile updated successfully');
    }

    public function updateVendor(VendorRequest $request) {
        $validated = $request->validated();
        $vendor = Auth::user()->vendor;

        // STORE FILE TO STORAGE
        foreach ($request->files as $file => $val)
            if ($request->file($file))
                $validated[$file] = $request->file($file)->store("documents/vendors/$file");

        $vendor->update($validated);
        return back()->with('success', 'Vendor edited successfully');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:8|max:255',
            'new_password' => 'required|min:8|max:255|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return back()->with('success', 'New password updated successfully');
        }

        return back()->with('error', 'The current password is incorrect');
    }

}
