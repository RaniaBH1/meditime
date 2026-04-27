<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | MediTime</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    @include('layouts.global-css')
    
    <style>
        /* Style pour le bouton Google (officiel) */
        .google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px 20px;
            background: white;
            border: 1px solid #dadce0;
            border-radius: 40px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            color: #3c4043;
            text-decoration: none;
            transition: background-color 0.2s, box-shadow 0.2s;
            cursor: pointer;
            gap: 12px;
            margin-bottom: 20px;
        }
        .google-btn:hover {
            background-color: #f8f9fa;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
            border-color: #d2e3fc;
        }
        .google-icon svg {
            width: 20px;
            height: 20px;
        }
        .separator {
            margin: 20px 0;
            text-align: center;
            font-size: 0.8rem;
            color: #888;
            position: relative;
        }
        .separator::before, .separator::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: #e0e0e0;
        }
        .separator::before { left: 0; }
        .separator::after { right: 0; }
    </style>
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

            <!-- Bouton "Se connecter avec Google" (officiel) -->
            <a href="{{ route('login.google') }}" class="google-btn">
                <span class="google-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20px" height="20px">
                        <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z" />
                        <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z" />
                        <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z" />
                        <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z" />
                    </svg>
                </span>
                <span>Se connecter avec Google</span>
            </a>

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