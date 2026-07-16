<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Helpers\AffineHelper;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
{
    $validated = $request->validateWithBag('updatePassword', [
        'current_password' => ['required'],
        'password' => ['required', Password::defaults(), 'confirmed'],
    ]);

    $user = $request->user();

    // Cek password lama
    if (AffineHelper::decrypt($user->password) !== $validated['current_password']) {
        return back()->withErrors([
            'current_password' => 'Password lama salah.',
        ], 'updatePassword');
    }

    // Simpan password baru dalam bentuk terenkripsi
    $user->update([
        'password' => AffineHelper::encrypt($validated['password']),
    ]);

    return back()->with('status', 'password-updated');
}
}
