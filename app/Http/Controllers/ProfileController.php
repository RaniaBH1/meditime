<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'nullable|string|max:20',
            'speciality' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'license_number' => 'nullable|string|max:255',
        ]);

        // Mettre à jour le nom
        $user->name = $request->name;
        
        // Mettre à jour les champs spécifiques aux médecins
        if ($user->role === 'medecin') {
            $user->phone = $request->phone;
            $user->speciality = $request->speciality;
            $user->address = $request->address;
            $user->license_number = $request->license_number;
        }

        // Gestion de la photo
        if ($request->hasFile('photo')) {
            try {
                // Supprimer l'ancienne photo si elle existe
                if ($user->photo && file_exists(public_path('photos/' . $user->photo))) {
                    unlink(public_path('photos/' . $user->photo));
                }
                
                $file = $request->file('photo');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                // Vérifier que le dossier existe
                if (!file_exists(public_path('photos'))) {
                    mkdir(public_path('photos'), 0755, true);
                }
                
                $file->move(public_path('photos'), $filename);
                $user->photo = $filename;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => 'Erreur lors de l\'upload: ' . $e->getMessage()]);
            }
        }

        $user->save();
        
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's profile photo.
     */
    public function destroyPhoto(Request $request)
    {
        $user = Auth::user();
        
        if ($user->photo) {
            // Supprimer le fichier physique
            $photoPath = public_path('photos/' . $user->photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
            
            // Supprimer la référence en base de données
            $user->photo = null;
            $user->save();
            
            return Redirect::route('profile.edit')->with('status', 'photo-deleted');
        }
        
        return Redirect::route('profile.edit')->with('status', 'no-photo');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Supprimer la photo si elle existe
        if ($user->photo && file_exists(public_path('photos/' . $user->photo))) {
            unlink(public_path('photos/' . $user->photo));
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}