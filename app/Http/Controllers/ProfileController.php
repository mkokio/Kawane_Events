<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


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

    public function store(Request $request):RedirectResponse
    {   // validation rules allow all of these to be optional
        $validated = $request->validate([
            'business_name' => 'nullable|max:100', 
            'public_name' => 'nullable|max:70', 
            'phone' => 'nullable|max:30', 
            'contact_email' => 'nullable|max:50', 
            'instagram' => 'nullable|max:50', 
            'twitter' => 'nullable|max:50', 
            'homepage' => 'nullable|max:100', 
            'colors' => 'nullable|in:1,2,3,4,5,6,7,8,9,10,18' // 18 is the default color charcoal

        ]);
    
        // Your logic to store the validated data in the database can go here.
        $request->user()->create($validated);
        // user() is from Laravel's built-in authentication system; user must be logged in
        // ->create($validated) creates a new event form record in the database of authenticated user. 

        // Redirect to a success page or wherever you need to go after storing the data.
        return redirect()->route('success.route.name');
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
}
