<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

        return Redirect::to('/');
    }

    public function edittheuser($id) {
        $user = User::findOrFail($id);
        //dd($user);
        return view('profile.editforall', compact('user'));
    }






    

    public function updateallusers(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'image_de_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        // Update basic fields
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->telephone = $request->telephone;
        $user->adresse = $request->adresse;
    
        // Handle profile picture upload
        if ($request->hasFile('image_de_profil')) {
            $imagePath = $request->file('image_de_profil')->store('profile_pictures', 'public');
            $user->image_de_profil = $imagePath;
        }
    
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }



}
