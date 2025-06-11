<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

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
    public function store(LoginRequest $request)
    {
        try {
            $request->authenticate();
            $request->session()->regenerate();

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'redirect' => RouteServiceProvider::HOME
                ]);
            }

            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (ValidationException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => [
                        'email' => ['These credentials do not match our records.']
                    ]
                ], 422);
            }
            throw $e;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($request->wantsJson()) {
            return response()->json(['status' => 'success']);
        }

        return redirect('/');
    }
}
