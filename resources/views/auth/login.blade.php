<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | MediTime</title>

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
        <div class="login-card">
            <h2>Connectez-vous à <span>MediTime</span></h2>

            <div class="tabs">
                <a href="{{ route('login') }}" class="tab active">Connexion</a>
                <a href="{{ route('register') }}" class="tab">Inscription</a>
            </div>

            @if (session('status'))
                <div class="status-text">
                    {{ session('status') }}
                </div>
            @endif

            <button type="button" class="social-btn">
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" style="width:20px;">
                Se connecter avec Google
            </button>

            <div class="separator">OU</div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                    >
                    @error('email')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Mot de passe"
                        required
                        autocomplete="current-password"
                    >
                    @error('password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="remember-row">
                    <label for="remember_me" class="remember-label">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>Se souvenir de moi</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn-submit">
                    Se connecter
                </button>
                <div class="back-home">
                    <a href="{{ url('/') }}"><span class="arrow">←</span> Retour à l'accueil </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>