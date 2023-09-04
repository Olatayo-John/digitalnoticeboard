<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

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

        $userId =  Auth::guard('web')->user()->id;
        $name =  Auth::guard('web')->user()->name;
        $email =  Auth::guard('web')->user()->email;
        $profilePic =  Auth::guard('web')->user()->profile_image;
        $timezone =  Auth::guard('web')->user()->time_zone;
        Session::put('userId', $userId);
        Session::put('name', $name);
        Session::put('email', $email);
        Session::put('profilePic', url('') . '/' . $profilePic);
        Session::put('timezone', $timezone);

        return redirect()->intended(RouteServiceProvider::ADMIN);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Session::flush();
        Auth::logout();
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
