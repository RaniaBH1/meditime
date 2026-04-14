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

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // === DÉBOGAGE AVEC error_log ===
        error_log('=== UPDATE PROFIL ===');
        error_log('Has photo? ' . ($request->hasFile('photo') ? 'OUI' : 'NON'));
        
        if ($request->hasFile('photo')) {
            error_log('Photo reçue - Nom: ' . $request->file('photo')->getClientOriginalName());
            error_log('Photo reçue - Taille: ' . $request->file('photo')->getSize());
            error_log('Photo reçue - Type: ' . $request->file('photo')->getMimeType());
        } else {
            error_log('AUCUNE photo reçue dans la requête');
        }
        // === FIN DÉBOGAGE ===

        $user = $request->user();
        $user->fill($request->validated());

        // Gestion de la photo
        if ($request->hasFile('photo')) {
            try {
                // Supprimer l'ancienne photo
                if ($user->photo && file_exists(public_path('photos/' . $user->photo))) {
                    unlink(public_path('photos/' . $user->photo));
                    error_log('Ancienne photo supprimée');
                }
                
                $file = $request->file('photo');
                $filename = time() . '_' . $file->getClientOriginalName();
                
                // Vérifier que le dossier existe
                if (!file_exists(public_path('photos'))) {
                    mkdir(public_path('photos'), 0755, true);
                    error_log('Dossier photos créé');
                }
                
                $file->move(public_path('photos'), $filename);
                $user->photo = $filename;
                error_log('Photo sauvegardée: ' . $filename);
            } catch (\Exception $e) {
                error_log('Erreur upload: ' . $e->getMessage());
                return back()->withErrors(['photo' => 'Erreur: ' . $e->getMessage()]);
            }
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        error_log('Utilisateur sauvegardé, photo = ' . $user->photo);
        
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