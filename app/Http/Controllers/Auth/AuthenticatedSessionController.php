<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

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
        $request->authenticate();

        $request->session()->regenerate();
        $user = Auth::user();
        activity('auth')
            ->causedBy($user)
            ->event('login')
            ->withProperties([
                'user_id'     => $user->id,
                'email'       => $user->email,
                // 'role'        => $user->getRoleNames()->first(),
                'ip'          => request()->ip(),
                'user_agent'  => request()->userAgent(),
            ])
            ->log("Pengguna '{$user->email}' berhasil login");
        return redirect()->intended(route('admin.index', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();
        activity('auth')
            ->causedBy($user)
            ->event('logout')
            ->withProperties([
                'user_id'     => $user->id,
                'email'       => $user->email,
                // 'role'        => $user->getRoleNames()->first(),
                'ip'          => request()->ip(),
                'user_agent'  => request()->userAgent(),
            ])
            ->log("Pengguna '{$user->email}' berhasil logout");
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();



        return redirect()->route('login');
    }

    protected function loggedOut(Request $request)
    {
        return redirect()->route('login');
    }
}
