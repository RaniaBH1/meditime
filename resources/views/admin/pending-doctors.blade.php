<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médecins en attente | MediTime</title>

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
            <a href="{{ route('admin.dashboard') }}" class="btn-login">Dashboard</a>

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
        <h1 class="section-title">Médecins <span>en attente</span></h1>
        <p class="section-subtitle">
            Vérifiez les informations soumises lors de l’inscription puis validez les comptes médecins.
        </p>

        @if(session('success'))
            <div class="status-text" style="margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @forelse($pendingDoctors as $doctor)
            <div class="list-card">
                <p><strong>Nom :</strong> {{ $doctor->name }}</p>
                <p><strong>Email :</strong> {{ $doctor->email }}</p>
                <p><strong>Téléphone :</strong> {{ $doctor->phone }}</p>
                <p><strong>Spécialité :</strong> {{ $doctor->speciality }}</p>
                <p><strong>Adresse :</strong> {{ $doctor->address }}</p>
                <p><strong>Numéro d’autorisation :</strong> {{ $doctor->license_number }}</p>

                <div class="dashboard-actions">
                    <form method="POST" action="{{ route('admin.medecins.approve', $doctor->id) }}">
                        @csrf
                        <button type="submit" class="dashboard-btn">Valider ce médecin</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="dashboard-card">
                <h3>Aucun médecin en attente</h3>
                <p>Toutes les demandes ont été traitées.</p>
            </div>
        @endforelse
    </section>

</body>
</html>