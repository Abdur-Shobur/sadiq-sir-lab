<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Show user profile edit form
     */
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', compact('user'));
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => ['required', 'email', \Illuminate\Validation\Rule::unique('users')->ignore($user->id)],
            'phone'            => 'nullable|string|max:20',
            'address'          => 'nullable|string|max:500',
            'bio'              => 'nullable|string|max:1000',
            'profile_image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password'     => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->except(['current_password', 'new_password', 'new_password_confirmation', 'profile_image']);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $imagePath             = $request->file('profile_image')->store('users', 'public');
            $data['profile_image'] = $imagePath;
        }

        // Update password if provided
        if ($request->filled('new_password')) {
            if (! Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            $data['password'] = Hash::make($request->new_password);
        }

        $user->update($data);

        return redirect()->route('dashboard.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }
}
