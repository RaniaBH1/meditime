<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil | MediTime</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    @include('layouts.global-css')
</head>
<body>

    <div class="background-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <div class="animated-bg">
        <div class="shape circle"></div>
        <div class="shape triangle"></div>
        <div class="shape square"></div>
    </div>

    <nav>
        <div class="logo">Medi<span>Time</span></div>

        <div class="nav-links">
            <a href="{{ route('dashboard') }}" class="btn-login">Accueil</a>

            @auth
                <a href="{{ route('profile.edit') }}" class="btn-login" style="background: white; color: var(--dark); border: 1px solid #e5e7eb;">
                    {{ auth()->user()->name }}
                </a>

                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="btn-login btn-signup">
                        Déconnexion
                    </button>
                </form>
            @endauth
        </div>
    </nav>

    <main class="profile-page">
        <div class="section-wrapper">
            <h1 class="page-title">Mon <span>profil</span></h1>
            <p class="page-subtitle">
                Gérez vos informations personnelles, modifiez votre mot de passe et sécurisez votre compte MediTime.
            </p>

            <div class="profile-grid">
                <div class="profile-card">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="profile-card">
                    @include('profile.partials.update-password-form')
                </div>

                <div class="profile-card danger-zone">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </main>

</body>
</html>