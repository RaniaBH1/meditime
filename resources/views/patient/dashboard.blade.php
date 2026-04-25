<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Dashboard Patient | MediTime</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @include('layouts.global-css')

    <style>
        :root {
            --accent: #00d2ff;
            --accent-dark: #3a7bd5;
            --dark: #1e272e;
            --glass: rgba(255, 255, 255, 0.5);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #eef2f3;
            min-height: 100vh;
            overflow-x: hidden;
            color: var(--dark);
            position: relative;
        }

        /* BLOCS ANIMÉS (identique à l'accueil) */
        .background-blobs {
            position: fixed;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            top: 0;
            left: 0;
        }

        .animated-bg {
            position: fixed;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
            z-index: -2;
            pointer-events: none;
        }

        .blob {
            position: absolute;
            filter: blur(60px);
            border-radius: 50%;
            animation: float 15s infinite alternate ease-in-out;
        }

        .blob-1 {
            width: 400px;
            height: 400px;
            background: var(--accent);
            top: -10%;
            right: -5%;
        }

        .blob-2 {
            width: 450px;
            height: 450px;
            background: var(--accent-dark);
            bottom: -10%;
            left: -5%;
        }

        @keyframes float {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-30px, 30px); }
        }

        /* FORMES SUPPLEMENTAIRES */
        .shape {
            position: absolute;
            background: rgba(58, 123, 213, 0.1);
            z-index: -2;
        }

        .circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            top: 20%;
            left: 10%;
        }

        .triangle {
            width: 0;
            height: 0;
            border-left: 50px solid transparent;
            border-right: 50px solid transparent;
            border-bottom: 80px solid rgba(0, 210, 255, 0.1);
            top: 70%;
            left: 80%;
            background: transparent;
        }

        .square {
            width: 90px;
            height: 90px;
            top: 18%;
            right: 12%;
            border-radius: 18px;
            transform: rotate(20deg);
            background: rgba(58, 123, 213, 0.08);
        }

        /* NAVIGATION (identique à l'accueil) */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 8%;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            z-index: 200;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--accent-dark), var(--accent));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .logo span {
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .nav-right {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        /* BOUTON "EYA" (même style que "Se connecter" avec hover bleu) */
        .user-btn {
            background: var(--dark);
            color: white;
            text-decoration: none;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            white-space: nowrap;
            transition: 0.3s;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .user-btn:hover {
            background: var(--accent-dark);
            transform: translateY(-2px);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--dark);
            font-weight: bold;
        }

        /* DROPDOWN MENU */
        .dropdown-menu {
            position: absolute;
            top: 80px;
            right: 8%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            width: 300px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: 0.3s;
            z-index: 1000;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.6);
        }

        .dropdown-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-header {
            padding: 24px 20px;
            text-align: center;
            background: rgba(58, 123, 213, 0.05);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .dropdown-header .user-initial {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--accent-dark), var(--accent));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            color: white;
            font-size: 1.8rem;
            font-weight: bold;
        }

        .dropdown-header h4 {
            color: var(--dark);
            margin-bottom: 4px;
        }

        .dropdown-header p {
            color: #6c757d;
            font-size: 0.8rem;
        }

        .dropdown-items {
            padding: 8px 0;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 24px;
            color: #2c3e50;
            text-decoration: none;
            transition: 0.2s;
            cursor: pointer;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: rgba(0, 210, 255, 0.1);
            color: var(--accent-dark);
            padding-left: 28px;
        }

        .logout-btn {
            border-top: 1px solid rgba(0,0,0,0.05);
            color: #dc3545;
        }

        .logout-btn:hover {
            background: #fff5f5;
            color: #dc3545;
        }

        /* MAIN CONTENT (centré, avec barre de recherche) */
        .main-dashboard {
            padding-top: 130px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .welcome-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--dark), var(--accent-dark));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .welcome-section p {
            font-size: 1.1rem;
            color: #4b5563;
            margin-top: 8px;
        }

        /* SEARCH BAR (style glass acceuil) */
        .search-container {
            width: 100%;
            max-width: 650px;
            margin: 0 auto 2rem;
        }

        .search-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            padding: 6px 10px;
            border-radius: 60px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: 0.2s;
        }

        .search-wrapper:focus-within {
            box-shadow: 0 15px 35px rgba(58, 123, 213, 0.2);
            transform: scale(1.01);
        }

        .search-wrapper input {
            flex: 1;
            border: none;
            outline: none;
            padding: 16px 20px;
            font-size: 1rem;
            border-radius: 60px;
            background: transparent;
            font-weight: 500;
        }

        .search-wrapper button {
            padding: 12px 28px;
            border: none;
            background: var(--accent-dark);
            color: white;
            font-weight: 700;
            border-radius: 50px;
            cursor: pointer;
            transition: 0.3s;
        }

        .search-wrapper button:hover {
            background: var(--accent);
            transform: translateY(-2px);
        }

        /* RÉSULTATS (cartes médecin) */
        .results-container {
            width: 100%;
            max-width: 750px;
            margin: 0 auto;
        }

        .doctor-card {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 16px 20px;
            background: white;
            border-radius: 28px;
            margin-top: 16px;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.05);
            transition: 0.25s;
            border: 1px solid rgba(0,0,0,0.03);
        }

        .doctor-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(58, 123, 213, 0.12);
            border-color: rgba(58, 123, 213, 0.2);
        }

        .doctor-photo-container {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
            border: 2px solid var(--accent-dark);
            background: #f8fafc;
        }

        .doctor-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .doctor-info {
            flex: 1;
        }

        .doctor-info strong {
            font-size: 1.2rem;
            display: block;
            margin-bottom: 4px;
            color: var(--dark);
        }

        .doctor-speciality {
            color: var(--accent-dark);
            font-weight: 600;
            font-size: 0.85rem;
            background: rgba(58, 123, 213, 0.1);
            display: inline-block;
            padding: 4px 12px;
            border-radius: 40px;
            margin-bottom: 8px;
        }

        .doctor-info small {
            font-size: 0.8rem;
            color: #5f6c7a;
            display: inline-block;
            margin-right: 16px;
        }

        .doctor-info a {
            display: inline-block;
            margin-top: 10px;
            font-weight: 600;
            color: var(--accent-dark);
            text-decoration: none;
            font-size: 0.85rem;
            border-bottom: 1px dashed;
        }

        .doctor-info a:hover {
            color: var(--accent);
        }

        .loading, .no-results {
            text-align: center;
            padding: 30px;
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(4px);
            border-radius: 32px;
            margin-top: 20px;
            font-weight: 500;
        }

        /* MODAL */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(6px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal-card {
            background: white;
            border-radius: 32px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 25px 40px rgba(0,0,0,0.2);
        }

        .modal-card h3 {
            margin-bottom: 20px;
            color: var(--dark);
        }

        .modal-card button {
            background: var(--accent-dark);
            border: none;
            padding: 10px 24px;
            border-radius: 40px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .modal-card button:hover {
            background: var(--accent);
        }

        @media (max-width: 700px) {
            .doctor-card {
                flex-direction: column;
                text-align: center;
            }
            .search-wrapper input {
                padding: 12px 16px;
            }
            .welcome-section h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>

<!-- FOND ANIMÉ (identique accueil) -->
<div class="background-blobs">
    <div class="animated-bg">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="shape circle"></div>
        <div class="shape triangle"></div>
        <div class="shape square"></div>
    </div>
</div>

<!-- NAVIGATION -->
<nav>
    <div class="logo">Medi<span>Time</span></div>
    <div class="nav-right">
        <button class="user-btn" onclick="toggleDropdown()">
            <span class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</span>
            {{ auth()->user()->name }}
        </button>
    </div>
</nav>

<!-- DROPDOWN MENU (Notifications, RDV, Profil, Réclamations, Déco) -->
<div class="dropdown-menu" id="dropdownMenu">
    <div class="dropdown-header">
        <div class="user-initial">{{ substr(auth()->user()->name, 0, 1) }}</div>
        <h4>{{ auth()->user()->name }}</h4>
        <p>{{ auth()->user()->email }}</p>
    </div>
    <div class="dropdown-items">
        <div class="dropdown-item" onclick="showNotifications()">🔔 Mes notifications</div>
        <div class="dropdown-item" onclick="showAppointments()">📅 Mes rendez-vous</div>
        <a href="{{ route('profile.edit') }}" class="dropdown-item">✏️ Modifier profil</a>
        <div class="dropdown-item" onclick="showComplaints()">📝 Réclamations</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dropdown-item logout-btn" style="width:100%; text-align:left;">🚪 Déconnexion</button>
        </form>
    </div>
</div>

<!-- CONTENU PRINCIPAL -->
<div class="main-dashboard">
    <div class="welcome-section">
        <h1>Bonjour <span>{{ auth()->user()->name }}</span></h1>
        <p>Bienvenue sur votre espace patient</p>
    </div>

    <!-- Barre de recherche -->
    <div class="search-container">
        <div class="search-wrapper">
            <input type="text" id="doctorInput" placeholder="Rechercher un médecin, une spécialité..." autocomplete="off">
            <button onclick="searchDoctors()">🔍 Rechercher</button>
        </div>
    </div>

    <!-- Résultats dynamiques -->
    <div class="results-container" id="results"></div>
</div>

<!-- MODALE GÉNÉRIQUE -->
<div id="modal" class="modal-overlay">
    <div class="modal-card">
        <div id="modalContent"></div>
        <button onclick="closeModal()">Fermer</button>
    </div>
</div>

<script>
    // ---------- DROPDOWN ----------
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('active');
    }

    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('dropdownMenu');
        const btn = document.querySelector('.user-btn');
        if (!btn.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.remove('active');
        }
    });

    // ---------- MODALES ----------
    function showNotifications() {
        const modal = document.getElementById('modal');
        document.getElementById('modalContent').innerHTML = `<h3>🔔 Mes notifications</h3><p>Aucune notification pour l'instant.</p>`;
        modal.style.display = 'flex';
        dropdownClose();
    }

    function showAppointments() {
        const modal = document.getElementById('modal');
        document.getElementById('modalContent').innerHTML = `<h3>📅 Mes rendez-vous</h3><p>Vous n'avez pas de rendez-vous programmé.</p><small>Utilisez la recherche pour prendre rendez-vous.</small>`;
        modal.style.display = 'flex';
        dropdownClose();
    }

    function showComplaints() {
        const modal = document.getElementById('modal');
        document.getElementById('modalContent').innerHTML = `
            <h3>📝 Réclamations</h3>
            <form onsubmit="submitComplaint(event)">
                <textarea id="complaintText" rows="4" style="width:100%; padding:12px; border-radius:16px; border:1px solid #ddd; margin-bottom:15px;" placeholder="Décrivez votre réclamation..."></textarea>
                <button type="submit">Envoyer</button>
            </form>
        `;
        modal.style.display = 'flex';
        dropdownClose();
    }

    function submitComplaint(e) {
        e.preventDefault();
        const text = document.getElementById('complaintText')?.value;
        if(text?.trim()) alert('✅ Réclamation envoyée :\n' + text);
        else alert('Veuillez écrire une réclamation.');
        closeModal();
    }

    function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }

    function dropdownClose() {
        document.getElementById('dropdownMenu').classList.remove('active');
    }

    // ---------- RECHERCHE MÉDECINS ----------
    function searchDoctors() {
        let query = document.getElementById('doctorInput').value.trim();
        let resultsDiv = document.getElementById('results');

        if (!query) {
            resultsDiv.innerHTML = '';
            return;
        }

        resultsDiv.innerHTML = '<div class="loading">⏳ Recherche de médecins...</div>';

        fetch(`/search-medecins?q=${encodeURIComponent(query)}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => {
            if (!res.ok) throw new Error(`HTTP ${res.status}`);
            return res.json();
        })
        .then(data => {
            if (!data || data.length === 0) {
                resultsDiv.innerHTML = `<div class="no-results">❌ Aucun médecin trouvé pour "${escapeHtml(query)}"</div>`;
                return;
            }

            resultsDiv.innerHTML = '';
            data.forEach(doctor => {
                let photoUrl = doctor.photo ? `/photos/${doctor.photo}` : '/images/default.png';
                resultsDiv.innerHTML += `
                    <div class="doctor-card">
                        <div class="doctor-photo-container">
                            <img src="${photoUrl}" alt="Dr. ${escapeHtml(doctor.name)}" class="doctor-photo" onerror="this.src='/images/default.png'">
                        </div>
                        <div class="doctor-info">
                            <strong>👨‍⚕️ Dr. ${escapeHtml(doctor.name)}</strong>
                            <div class="doctor-speciality">🏥 ${escapeHtml(doctor.speciality ?? 'Spécialité non définie')}</div>
                            ${doctor.address ? `<small>📍 ${escapeHtml(doctor.address)}</small>` : ''}
                            ${doctor.phone ? `<small>📞 ${escapeHtml(doctor.phone)}</small>` : ''}
                            <br>
                            <a href="/medecin/${doctor.id}">📅 Voir calendrier →</a>
                        </div>
                    </div>
                `;
            });
        })
        .catch(err => {
            console.error(err);
            resultsDiv.innerHTML = '<div class="no-results" style="color:#c0392b;">⚠️ Erreur de connexion. Réessayez.</div>';
        });
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }

    document.getElementById('doctorInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') searchDoctors();
    });

    document.addEventListener('DOMContentLoaded', () => {
        console.log('Dashboard patient prêt - style Accueil intégré');
    });
</script>

</body>
</html>