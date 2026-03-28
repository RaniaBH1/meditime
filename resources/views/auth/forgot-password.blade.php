<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié | MediTime</title>

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
            <h2>Mot de passe <span>oublié</span></h2>

            <div class="tabs">
                <a href="{{ route('login') }}" class="tab">Connexion</a>
                <a href="{{ route('password.request') }}" class="tab active">Réinitialisation</a>
            </div>

            <div class="status-text" style="background:#f8fafc; color:#475569; border:1px solid #e2e8f0;">
                Saisissez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
            </div>

            @if (session('status'))
                <div class="status-text">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
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

                <button type="submit" class="btn-submit">
                    Envoyer le lien de réinitialisation
                </button>

                <div class="bottom-link">
                    Retour à
                    <a href="{{ route('login') }}">la connexion</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>