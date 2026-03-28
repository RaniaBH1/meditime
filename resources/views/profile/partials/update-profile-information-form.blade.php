<section>
    <header>
        <h3>Informations du profil</h3>
        <p>
            Mettez à jour vos informations personnelles et, si vous êtes médecin, vos informations professionnelles.
        </p>
    </header>

    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name">Nom complet</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
            >
            @error('name')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Adresse email</label>
            <input
                id="email"
                type="email"
                value="{{ $user->email }}"
                disabled
            >
            <p style="font-size:13px;color:#6b7280;margin-top:6px;">
                L’adresse email ne peut pas être modifiée.
            </p>
        </div>

        <div class="form-group">
            <label for="role_display">Type de compte</label>
            <input
                id="role_display"
                type="text"
                value="{{ ucfirst($user->role) }}"
                disabled
            >
        </div>

        @if($user->role === 'medecin')
            <div class="form-group">
                <label for="phone">Téléphone</label>
                <input
                    id="phone"
                    name="phone"
                    type="text"
                    value="{{ old('phone', $user->phone) }}"
                    placeholder="Ex : 22 123 456"
                >
                @error('phone')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="speciality">Spécialité</label>
                <input
                    id="speciality"
                    name="speciality"
                    type="text"
                    value="{{ old('speciality', $user->speciality) }}"
                    placeholder="Ex : Cardiologie"
                >
                @error('speciality')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Adresse du cabinet</label>
                <input
                    id="address"
                    name="address"
                    type="text"
                    value="{{ old('address', $user->address) }}"
                    placeholder="Adresse du cabinet"
                >
                @error('address')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="license_number">Numéro d'autorisation</label>
                <input
                    id="license_number"
                    name="license_number"
                    type="text"
                    value="{{ old('license_number', $user->license_number) }}"
                    placeholder="Numéro d'autorisation"
                >
                @error('license_number')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="status-text" style="margin-top: 10px;">
                Ces informations complètent votre profil professionnel médecin.
            </div>
        @endif

        <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap; margin-top: 20px;">
            <button type="submit">
                Enregistrer
            </button>

            @if (session('status') === 'profile-updated')
                <span style="color: #4b5563; font-size: 14px;">
                    Modifications enregistrées.
                </span>
            @endif
        </div>
    </form>
</section>