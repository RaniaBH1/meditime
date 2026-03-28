<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | MediTime</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    @include('layouts.global-css')
</head>
<body>

    <div class="background-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <div class="login-container">
        <div class="login-card register-card">
            <h2>Créez votre compte <span>MediTime</span></h2>

            <div class="tabs">
                <a href="{{ route('login') }}" class="tab">Connexion</a>
                <a href="{{ route('register') }}" class="tab active">Inscription</a>
            </div>

            <button type="button" class="social-btn" disabled>
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" style="width:20px;">
                S’inscrire avec Google
            </button>

            <div class="separator">OU</div>

            @if (session('status'))
                <div class="status-text">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <select id="role" name="role" required>
                        <option value="">Type du compte</option>
                        <option value="patient" {{ old('role') === 'patient' ? 'selected' : '' }}>Patient</option>
                        <option value="medecin" {{ old('role') === 'medecin' ? 'selected' : '' }}>Médecin</option>
                    </select>
                    @error('role')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Nom complet"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                    >
                    @error('name')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="username"
                    >
                    @error('email')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                

                <div id="medecin-fields" class="{{ old('role') === 'medecin' ? '' : 'hidden-block' }}">
                    <div class="form-group">
                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            placeholder="Téléphone"
                            value="{{ old('phone') }}"
                        >
                        @error('phone')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input
                            type="text"
                            id="speciality"
                            name="speciality"
                            placeholder="Spécialité"
                            value="{{ old('speciality') }}"
                        >
                        @error('speciality')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input
                            type="text"
                            id="address"
                            name="address"
                            placeholder="Adresse du cabinet"
                            value="{{ old('address') }}"
                        >
                        @error('address')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input
                            type="text"
                            id="license_number"
                            name="license_number"
                            placeholder="Numéro d'autorisation"
                            value="{{ old('license_number') }}"
                        >
                        @error('license_number')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="status-text" style="margin-top: 10px;">
                        Les comptes médecins doivent être validés par l’administrateur avant connexion.
                    </div>
                </div>

                <div class="form-group">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Mot de passe"
                        required
                        autocomplete="new-password"
                    >
                    @error('password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Confirmer le mot de passe"
                        required
                        autocomplete="new-password"
                    >
                    @error('password_confirmation')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    S’inscrire
                </button>

                <div class="bottom-link">
                    Déjà inscrit ?
                    <a href="{{ route('login') }}">Se connecter</a>
                </div>
                <div class="back-home">
                    <a href="{{ url('/') }}"><span class="arrow">←</span> Retour à l'accueil </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role');
            const medecinFields = document.getElementById('medecin-fields');

            function toggleMedecinFields() {
                if (roleSelect.value === 'medecin') {
                    medecinFields.classList.remove('hidden-block');
                } else {
                    medecinFields.classList.add('hidden-block');
                }
            }

            roleSelect.addEventListener('change', toggleMedecinFields);
            toggleMedecinFields();
        });
    </script>

</body>
</html>