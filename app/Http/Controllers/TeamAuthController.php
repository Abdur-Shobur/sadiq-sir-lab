<?php
namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'specialities.*'          => 'string|max:255',
            'education'               => 'nullable|array',
            'education.*'             => 'string|max:500',
            'experience'              => 'nullable|array',
            'experience.*'            => 'string|max:500',
            'address'                 => 'nullable|string|max:500',
            'phone'                   => 'nullable|string|max:20',
            'email'                   => ['required', 'email', \Illuminate\Validation\Rule::unique('teams')->ignore($team->id)],
            'website'                 => 'nullable|url|max:255',
            'social_media'            => 'nullable|array',
            'social_media.*.platform' => 'required|string|max:50',
            'social_media.*.url'      => 'required|url|max:255',
            'current_password'        => 'nullable|required_with:new_password',
            'new_password'            => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->except(['current_password', 'new_password', 'new_password_confirmation']);

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
}
