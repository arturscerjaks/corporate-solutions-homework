<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    /**
     * Create a personal access token if credentials match, logout previous
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createToken(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        // It would be unsafe to say whether an email or password is registered here
        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Only let 1 token persist per account
        $user->tokens()->where('name', (string) $user->id)->delete();

        $token = $user->createToken((string) $user->id)->plainTextToken;

        return response()->json([
            'message' => "You've logged in successfully.",
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Logout user by deleting their personal access token(s)
     *
     * @return JsonResponse
     */
    public function deleteToken(Request $request): JsonResponse
    {
        $request->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([
            'message' => "You've logged out successfully."
        ]);
    }
}
