<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Patient | MediTime</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    @include('layouts.global-css')

    <style>
        .search-box {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .search-box input {
            flex: 1;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .search-box button {
            padding: 10px 16px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .doctor-result {
            margin-top: 10px;
            padding: 12px;
            border: 1px solid #eee;
            border-radius: 10px;
            background: white;
        }

        .doctor-result a {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
        }
    </style>
</head>

<body>

<!-- NAV -->
<nav>
    <div class="logo">Medi<span>Time</span></div>

    <div class="nav-links">
        <a href="{{ route('patient.dashboard') }}" class="btn-login">Accueil</a>

        <a href="{{ route('profile.edit') }}" class="btn-login"
           style="background: white; color: var(--dark); border: 1px solid #e5e7eb;">
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

<!-- DASHBOARD -->
<section class="dashboard-page">

    <h1 class="section-title">
        Bonjour <span>{{ auth()->user()->name }}</span>
    </h1>

    <p class="section-subtitle">
        Retrouvez rapidement vos actions principales : recherche de médecins, prise de rendez-vous et gestion de votre profil.
    </p>

    <div class="dashboard-grid">

        <!-- SEARCH -->
        <div class="dashboard-card">
            <h3>Rechercher un médecin</h3>
            <p>Trouvez un spécialiste selon la spécialité ou le nom.</p>

            <div class="search-box">
                <input type="text" id="doctorInput" placeholder="Nom ou spécialité...">
                <button onclick="searchDoctors()">Trouver</button>
            </div>

            <div id="results"></div>
        </div>

        <!-- APPOINTMENTS -->
        <div class="dashboard-card">
            <h3>Mes rendez-vous</h3>
            <p>Consultez vos rendez-vous à venir, les historiques et les demandes en attente.</p>
            <div class="dashboard-stat">0</div>
        </div>

        <!-- PROFILE -->
        <div class="dashboard-card">
            <h3>Mon profil</h3>
            <p>Mettez à jour vos informations personnelles et votre mot de passe.</p>
            <a href="{{ route('profile.edit') }}" class="dashboard-btn">Modifier</a>
        </div>

    </div>
</section>

<!-- JS SEARCH -->
<script>
function searchDoctors() {
    let query = document.getElementById('doctorInput').value.trim();

    if (!query) {
        document.getElementById('results').innerHTML = "";
        return;
    }

    fetch(`/search-medecins?q=${encodeURIComponent(query)}`)
        .then(res => res.json())
        .then(data => {
            let results = document.getElementById('results');
            results.innerHTML = "";

            if (!data || data.length === 0) {
                results.innerHTML = "<p>Aucun médecin trouvé</p>";
                return;
            }

            data.forEach(doc => {
                results.innerHTML += `
                    <div class="doctor-result">
                        <strong><p>Dr. ${doc.name}</p></strong>
                        <small>${doc.speciality ?? 'Spécialité non définie'}</small><br><small>${doc.address}</small><br><small>${doc.phone}</small><br>
                        <a href="/medecin/${doc.id}">
                            Voir calendrier →
                        </a>
                    </div>
                `;
            });
        })
        .catch(err => {
            console.error(err);
            document.getElementById('results').innerHTML =
                "<p>Erreur de chargement</p>";
        });
}
</script>

</body>
</html>