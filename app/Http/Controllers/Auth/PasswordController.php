<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()],
        ],[
            'current_password.required' => 'Please fill in your old password.',
            'current_password.current_password' => 'The old password you entered is incorrect.',
            'password.min' => 'The password field must be at least 8 characters.',
            'password.letters' => 'The password field must contain at least one letter.',
            'password.mixed' => 'The password field must contain at least one uppercase and one lowercase letter.',
            'password.numbers' => 'The password field must contain at least one number.',
            'password.confirmed' => 'The password field confirmation does not match.',
            'password.required' => 'Harap isi password Anda.',
            
    ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back();
    }
}
