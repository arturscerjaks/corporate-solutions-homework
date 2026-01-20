<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Return the login view or redirect to /products if logged in
     *
     * @return View|RedirectResponse
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/products');
        }

        return view('auth.login');
    }

    /**
     * Log the user in
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/products');
        }

        // Telling which is wrong would be bad for security
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Log the user out and return to the homepage (used as login page)
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
