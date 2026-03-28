<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | MediTime</title>

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
            <a href="{{ route('admin.dashboard') }}" class="btn-login">Accueil</a>

            <a href="{{ route('profile.edit') }}" class="btn-login" style="background: white; color: var(--dark); border: 1px solid #e5e7eb;">
                {{ auth()->user()->name }}
            </a>

            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="btn-login btn-signup">
                    Déconnexion
                </button>
            </form>
        </div>
    </nav>

    <section class="dashboard-page">
        <h1 class="section-title">Dashboard <span>Administrateur</span></h1>
        <p class="section-subtitle">
            Supervisez l’application, consultez les comptes médecins en attente et gérez l’activité générale de MediTime.
        </p>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3>Médecins en attente</h3>
                <p>Nombre de comptes médecins à vérifier avant validation.</p>
                <div class="dashboard-stat">{{ $pendingDoctorsCount }}</div>
                <div class="dashboard-actions">
                    <a href="{{ route('admin.medecins.pending') }}" class="dashboard-btn">Voir la liste</a>
                </div>
            </div>

            <div class="dashboard-card">
                <h3>Gestion des profils</h3>
                <p>Accédez aux informations administratives et suivez les rôles de la plateforme.</p>
                <div class="dashboard-actions">
                    <a href="{{ route('profile.edit') }}" class="dashboard-btn secondary">Mon profil</a>
                </div>
            </div>
        </div>
    </section>

</body>
</html>