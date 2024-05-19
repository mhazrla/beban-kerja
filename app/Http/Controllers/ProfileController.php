<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rules;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function create(): View
    {
        return view('profile.create');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'role_id' => ['required', 'string', 'max:255'],
                'contact' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users,username'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $filename = 'undraw_profile.svg'; // Default value

            if ($request->hasFile('photo')) {
                $filename = time() . '.' . $request->photo->getClientOriginalExtension();
                $path = $request->photo->storeAs('photos', $filename, 'public');
            }

            User::create([
                'name' => $request->name,
                'role_id' => $request->role_id,
                'contact' => $request->contact,
                'password' => Hash::make($request->password),
                'username' => $request->username,
                'photo' => $path,
            ]);

            Alert::success('Success!', 'User Created Successfully');

            return redirect(route('dashboard', absolute: false));
        } catch (\Exception $e) {
            Alert::error('Error!', $e->getMessage());
            return back();
        }
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        Alert::success('Success!', 'User Updated Successfully');

        return Redirect::route('profile.edit');
    }

    /**
     * Update the user's profile information.
     */
    public function updatePhoto(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $user = $request->user();

            if ($request->hasFile('photo')) {
                // Delete the old photo if it exists
                if ($user->photo) {
                    $oldPhotoPath = public_path('storage/' . $user->photo);
                    if (file_exists($oldPhotoPath)) {
                        unlink($oldPhotoPath);
                    }
                }

                $filename = time() . '.' . $request->photo->getClientOriginalExtension();
                $path = $request->photo->storeAs('photos', $filename, 'public');

                // Update the user's photo path in the database
                $user->update(['photo' => $path]);
            }

            return Redirect::route('profile.edit')->with('status', 'Profile updated successfully.');
        } catch (\Exception $e) {
            // Log the error message for debugging purposes
            Alert::error('Error!', $e->getMessage());
            // Return back with an error message
            return back()->withErrors(['photo' => 'Failed to update photo. Please try again.']);
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }
}
