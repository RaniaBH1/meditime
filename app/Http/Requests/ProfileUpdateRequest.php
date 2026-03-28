<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $user = $this->user();

        return [
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],

            // Champs médecin
            'phone' => [
                Rule::requiredIf($user && $user->role === 'medecin'),
                'nullable',
                'string',
                'max:20'
            ],

            'speciality' => [
                Rule::requiredIf($user && $user->role === 'medecin'),
                'nullable',
                'string',
                'max:255'
            ],

            'address' => [
                Rule::requiredIf($user && $user->role === 'medecin'),
                'nullable',
                'string',
                'max:255'
            ],

            'license_number' => [
                Rule::requiredIf($user && $user->role === 'medecin'),
                'nullable',
                'string',
                'max:255'
            ],
        ];
    }
}