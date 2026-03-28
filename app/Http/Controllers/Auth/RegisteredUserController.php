<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:patient,medecin'],

            'phone' => ['required_if:role,medecin', 'nullable', 'string', 'max:20'],
            'speciality' => ['required_if:role,medecin', 'nullable', 'string', 'max:255'],
            'address' => ['required_if:role,medecin', 'nullable', 'string', 'max:255'],
            'license_number' => ['required_if:role,medecin', 'nullable', 'string', 'max:255'],
        ]);

        $isMedecin = $request->role === 'medecin';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'is_approved' => $isMedecin ? false : true,
            'phone' => $isMedecin ? $request->phone : null,
            'speciality' => $isMedecin ? $request->speciality : null,
            'address' => $isMedecin ? $request->address : null,
            'license_number' => $isMedecin ? $request->license_number : null,
        ]);

        event(new Registered($user));

        if ($isMedecin) {
            return redirect()->route('login')->with('status', 'Votre demande de compte médecin a été envoyée. Elle doit être validée par l’administrateur.');
        }

        Auth::login($user);

        return redirect()->route('patient.dashboard');
    }
}