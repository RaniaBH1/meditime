<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Médecin | MediTime</title>

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
            <a href="{{ route('medecin.dashboard') }}" class="btn-login">Accueil</a>

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
    
        <h1 class="section-title">Bienvenue Dr. <span>{{ auth()->user()->name }}</span></h1>
        <p class="section-subtitle">
            Gérez votre activité médicale, vos horaires, vos rendez-vous et votre profil professionnel.
        </p>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3>Mes rendez-vous</h3>
                <p>Visualisez les rendez-vous à venir et organisez votre journée facilement.</p>
                <div class="dashboard-stat">0</div>
                <div class="dashboard-actions">
                    <a href="#" class="dashboard-btn">Consulter</a>
                </div>
            </div>

            <div class="dashboard-card">
                <h3>Disponibilités</h3>
                <p>Ajoutez ou modifiez vos créneaux afin que les patients puissent réserver.</p>
                <div class="dashboard-actions">
                    <a href="#" class="dashboard-btn">Gérer</a>
                </div>
            </div>

            <div class="dashboard-card">
                <h3>Mon profil </h3>
                <p>Complétez vos informations : spécialité, téléphone, adresse du cabinet et présentation.</p>
                <div class="dashboard-actions">
                    <a href="{{ route('profile.edit') }}" class="dashboard-btn secondary">Modifier</a>
                </div>
            </div>
        </div>
    </section>

</body>
</html>