<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Check if user is already logged in (either as admin or team member)
        $wasLoggedIn      = false;
        $previousUserType = null;

        if (Auth::check()) {
            $wasLoggedIn      = true;
            $previousUserType = 'admin';
            Auth::logout();
        } elseif (Auth::guard('team')->check()) {
            $wasLoggedIn      = true;
            $previousUserType = 'team';
            Auth::guard('team')->logout();
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Show message if user was previously logged in
            if ($wasLoggedIn) {
                return redirect()->intended('/dashboard')->with('success',
                    'Previous session ended. You are now logged in as admin.');
            }

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
