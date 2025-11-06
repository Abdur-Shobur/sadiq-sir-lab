<?php
namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class TeamAuthController extends Controller
{
    /**
     * Show team login form
     */
    public function showLogin()
    {
        return view('team.auth.login');
    }

    /**
     * Handle team login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $remember = (bool) $request->boolean('remember');

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

        // Use guard attempt and require is_active = true
        if (! Auth::guard('team')->attempt([
            'email'     => $credentials['email'],
            'password'  => $credentials['password'],
            'is_active' => true,
        ], $remember)) {
            return back()->withErrors([
                'email' => 'Invalid credentials or inactive account.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        // Show message if user was previously logged in
        if ($wasLoggedIn) {
            return redirect()->intended(route('team.dashboard'))->with('success',
                'Previous session ended. You are now logged in as team member.');
        }

        return redirect()->intended(route('team.dashboard'));
    }

    /**
     * Handle team logout
     */
    public function logout(Request $request)
    {
        Auth::guard('team')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/team-login');
    }

    /**
     * Show team profile
     */
    public function profile()
    {
        $team = Auth::guard('team')->user();
        return view('team.dashboard.profile', compact('team'));
    }

    /**
     * Update team profile
     */
    public function updateProfile(Request $request)
    {
        $team = Auth::guard('team')->user();

        $request->validate([
            'name'                    => 'required|string|max:255',
            'image'                   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'designation'             => 'required|string|max:255',
            'specialities'            => 'nullable|array',
            'specialities.*'          => 'nullable|string|max:255',
            'education'               => 'nullable|array',
            'education.*'             => 'nullable|string|max:500',
            'experience'              => 'nullable|array',
            'experience.*'            => 'nullable|string|max:500',
            'address'                 => 'nullable|string|max:500',
            'phone'                   => 'nullable|string|max:20',
            'email'                   => ['required', 'email', \Illuminate\Validation\Rule::unique('teams')->ignore($team->id)],
            'website'                 => 'nullable|url|max:255',
            'social_media'            => 'nullable|array',
            'social_media.*.platform' => 'nullable|string|max:50',
            'social_media.*.url'      => 'nullable|url|max:255',
            'current_password'        => 'nullable|required_with:new_password',
            'new_password'            => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->except(['current_password', 'new_password', 'new_password_confirmation']);

        // Clean up array data - remove empty entries
        if (isset($data['specialities'])) {
            $data['specialities'] = array_filter($data['specialities'], function ($item) {
                return ! empty(trim($item));
            });
            $data['specialities'] = array_values($data['specialities']); // Re-index array
        }

        if (isset($data['education'])) {
            $data['education'] = array_filter($data['education'], function ($item) {
                return ! empty(trim($item));
            });
            $data['education'] = array_values($data['education']); // Re-index array
        }

        if (isset($data['experience'])) {
            $data['experience'] = array_filter($data['experience'], function ($item) {
                return ! empty(trim($item));
            });
            $data['experience'] = array_values($data['experience']); // Re-index array
        }

        // Clean up social media data - remove empty entries
        if (isset($data['social_media'])) {
            $data['social_media'] = array_filter($data['social_media'], function ($social) {
                return ! empty($social['platform']) && ! empty($social['url']);
            });
            $data['social_media'] = array_values($data['social_media']); // Re-index array
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($team->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($team->image);
            }
            $imagePath     = $request->file('image')->store('teams', 'public');
            $data['image'] = $imagePath;
        }

        // Update password if provided
        if ($request->filled('new_password')) {
            if (! Hash::check($request->current_password, $team->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            $data['password'] = Hash::make($request->new_password);
        }

        $team->update($data);

        return redirect()->route('team.profile')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Show team forgot password form
     */
    public function showForgotPassword()
    {
        return view('team.auth.forgot-password');
    }

    /**
     * Send password reset link to team member
     */
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('teams')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Show team reset password form
     */
    public function showResetPassword(Request $request, $token)
    {
        return view('team.auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Reset team member password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::broker('teams')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($team, $password) {
                $team->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $team->save();

                event(new PasswordReset($team));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('team.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
