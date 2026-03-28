<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Patient | MediTime</title>

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
            <a href="{{ route('patient.dashboard') }}" class="btn-login">Accueil</a>

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
        <h1 class="section-title">Bonjour <span>{{ auth()->user()->name }}</span></h1>
        <p class="section-subtitle">
            Retrouvez rapidement vos actions principales : recherche de médecins, prise de rendez-vous et gestion de votre profil.
        </p>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3>Rechercher un médecin</h3>
                <p>Trouvez un spécialiste selon la spécialité, la localisation ou la disponibilité.</p>
                <div class="dashboard-actions">
                    <a href="{{ route('dashboard') }}" class="dashboard-btn">Rechercher</a>
                </div>
            </div>

            <div class="dashboard-card">
                <h3>Mes rendez-vous</h3>
                <p>Consultez vos rendez-vous à venir, les historiques et les demandes en attente.</p>
                <div class="dashboard-stat">0</div>
                <div class="dashboard-actions">
                    <a href="#" class="dashboard-btn secondary">Voir</a>
                </div>
            </div>

            <div class="dashboard-card">
                <h3>Mon profil</h3>
                <p>Mettez à jour vos informations personnelles et votre mot de passe.</p>
                <div class="dashboard-actions">
                    <a href="{{ route('profile.edit') }}" class="dashboard-btn">Modifier</a>
                </div>
            </div>
        </div>
    </section>

</body>
</html>