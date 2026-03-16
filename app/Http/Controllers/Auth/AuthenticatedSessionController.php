<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
       $request->authenticate(); // otomatis cek email/password

    $request->session()->regenerate();

    $user = Auth::user();
    $email = $user->email;

    // redirect sesuai role
    if (str_starts_with($email, '01') && str_ends_with($email, '@staff.edu')) {
        return redirect()->route('admin.dashboard');
    } elseif (str_starts_with($email, '02') && str_ends_with($email, '@operator.edu')) {
        return redirect()->route('operator.dashboard');
    } else {
        return redirect('/'); // dosen & mahasiswa
    }
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}