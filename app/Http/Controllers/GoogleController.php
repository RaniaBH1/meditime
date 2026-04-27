<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirige l'utilisateur vers la page d'authentification Google.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Traite le retour de Google après authentification.
     */
    public function handleGoogleCallback()
    {
        try {
            // Récupère les informations de l'utilisateur authentifié par Google
            $googleUser = Socialite::driver('google')->user();

            // Vérifie si l'utilisateur existe déjà via son google_id
            $user = User::where('google_id', $googleUser->getId())->first();

            if (!$user) {
                // Vérifie aussi si l'email n'est pas déjà utilisé par un compte classique
                $existingUser = User::where('email', $googleUser->getEmail())->first();

                if ($existingUser) {
                    // Si l'email existe, on lui associe le google_id pour les prochaines connexions
                    $existingUser->update([
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                    ]);
                    $user = $existingUser;
                } else {
                    // Création d'un nouvel utilisateur
                    $user = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                        // Le mot de passe est laissé vide car l'utilisateur se connecte via Google
                        'password' => bcrypt('secure-random-password'),
                    ]);
                }
            }

            // Connecte l'utilisateur
            Auth::login($user);

            // Redirige l'utilisateur vers son tableau de bord
            return redirect()->route('patient.dashboard'); // Ou la route de votre choix
        } catch (\Exception $e) {
            // En cas d'erreur, redirige vers la page de connexion avec un message
            return redirect()->route('login')->with('error', 'Une erreur est survenue lors de la connexion avec Google.');
        }
    }
}