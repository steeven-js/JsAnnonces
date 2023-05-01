<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

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

    public function storeAvatar(Request $request)
    {
        // Récupérer l'utilisateur actuellement authentifié
        $user = Auth::user();

        $user = $request->user();
    
        // Vérifier si l'utilisateur a déjà un avatar
        if ($user->avatar) {
            // Supprimer l'ancienne image
            Storage::delete($user->avatar);
        }
    
        // Traitement de l'upload de l'image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images/avatars');
            $user->avatar = $path;
            $user->save();
        }
    
        return redirect()->route('profile.edit');
    }
    
    
}
