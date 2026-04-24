<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche Médecin | MediTime</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            <a href="{{ route('profile.edit') }}" class="btn-login" style="background:white;color:var(--dark);border:1px solid #e5e7eb;">
                {{ auth()->user()->name }}
            </a>
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="btn-login btn-signup">Déconnexion</button>
            </form>
        </div>
    </nav>

    <div class="dashboard-page">
        <h1 class="section-title">Rechercher un <span>Médecin</span></h1>
        <p class="section-subtitle">Trouvez un spécialiste par nom ou spécialité.</p>

        <form method="GET" action="{{ route('patient.recherche') }}" style="display:flex;gap:12px;max-width:700px;margin-bottom:30px;">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Nom du médecin ou spécialité..."
                style="flex:1;padding:16px 24px;border:none;border-radius:50px;font-size:1rem;outline:none;box-shadow:0 4px 20px rgba(0,0,0,0.08);font-family:Poppins,sans-serif;"
            >
            <button type="submit" class="btn-login btn-signup" style="white-space:nowrap;">Rechercher</button>
        </form>

        <p style="color:#6b7280;font-size:0.9rem;margin-bottom:20px;">
            {{ $medecins->count() }} médecin(s) trouvé(s)
        </p>

        <div class="recherche-liste">
            @forelse($medecins as $medecin)
                <div class="dashboard-card" style="display:flex;align-items:center;gap:24px;padding:20px 28px;">

                    <img
                        src="{{ $medecin->photo ? asset('photos/' . $medecin->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($medecin->name) . '&background=3a7bd5&color=fff&size=100' }}"
                        alt="Dr. {{ $medecin->name }}"
                        style="width:85px;height:85px;border-radius:50%;object-fit:cover;border:3px solid var(--accent-dark);box-shadow:0 4px 12px rgba(58,123,213,0.25);flex-shrink:0;"
                    >

                    <div style="flex:1;">
                        <h3 style="font-size:1.2rem;font-weight:700;color:var(--dark);margin-bottom:6px;">
                            Dr. {{ $medecin->name }}
                        </h3>
                        <span style="display:inline-block;background:#e0f0ff;color:var(--accent-dark);padding:3px 14px;border-radius:20px;font-size:0.78rem;font-weight:600;margin-bottom:10px;">
                            {{ ucfirst($medecin->speciality ?? 'Non renseigné') }}
                        </span>
                        @if($medecin->address)
                            <div style="font-size:0.85rem;color:#6b7280;margin-bottom:3px;">📍 {{ $medecin->address }}</div>
                        @endif
                        @if($medecin->phone)
                            <div style="font-size:0.85rem;color:#6b7280;margin-bottom:3px;">📞 {{ $medecin->phone }}</div>
                        @endif
                        <div style="font-size:0.85rem;color:#6b7280;">✉️ {{ $medecin->email }}</div>
                    </div>

                    <a href="{{ route('doctor.show', $medecin->id) }}" class="dashboard-btn">
                        Voir Profil
                    </a>
                </div>
            @empty
                <div class="dashboard-card" style="text-align:center;padding:60px 20px;">
                    <p style="color:#9ca3af;">Aucun médecin trouvé. Essayez un autre nom ou spécialité.</p>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>