<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Calendrier | MediTime</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --accent: #00d2ff;
        --accent-dark: #3a7bd5;
        --dark: #1e272e;
        --glass: rgba(255, 255, 255, 0.5);
        --bg: #eef2f3;
        --surface: #ffffff;
        --border: #e5e7eb;
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

    /* Background blobs */
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

    /* NAVBAR */
    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 8%;
        position: fixed;
        width: 100%;
        top: 0;
        left: 0;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--border);
        z-index: 1000;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .logo {
        font-size: 22px;
        font-weight: 800;
    }

    .logo span {
        color: var(--accent-dark);
    }

    .nav-links {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .btn-login {
        padding: 10px 18px;
        border-radius: 30px;
        text-decoration: none;
        background: var(--dark);
        color: white;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-login:hover {
        background: var(--accent-dark);
        transform: translateY(-2px);
    }

    /* PAGE CALENDAR */
    .calendar-page {
        padding: 120px 8% 50px;
    }

    /* DOCTOR CARD */
    .doctor-banner {
        background: white;
        padding: 20px 25px;
        border-radius: 20px;
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .doctor-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid var(--accent-dark);
    }

    .doctor-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .doctor-banner h2 {
        font-size: 1.5rem;
        margin-bottom: 5px;
        color: var(--dark);
    }

    .doctor-banner p {
        color: #6b7280;
        font-size: 0.9rem;
    }

    /* GRID */
    .main-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 25px;
    }

    /* CALENDAR CONTAINER */
    .calendar-container,
    .time-slots,
    .confirm-panel {
        background: white;
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        border-bottom: 1px solid var(--border);
        background: linear-gradient(135deg, var(--accent-dark), var(--accent));
    }

    .calendar-header h3 {
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        text-transform: capitalize;
    }

    .calendar-header button {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 25px;
        cursor: pointer;
        font-weight: 600;
        transition: 0.3s;
    }

    .calendar-header button:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.05);
    }

    .calendar-dates {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
        padding: 20px;
    }

    .cal-day {
        text-align: center;
        padding: 12px;
        border-radius: 12px;
        cursor: pointer;
        transition: 0.2s;
        font-weight: 500;
    }

    .cal-day:hover {
        background: #eaf6ff;
        transform: scale(1.05);
    }

    .cal-day.selected {
        background: linear-gradient(135deg, var(--accent-dark), var(--accent));
        color: white;
    }

    /* TIME SLOTS */
    .time-slots {
        padding: 15px;
    }

    .time-slots h3 {
        margin-bottom: 15px;
        color: var(--dark);
        font-weight: 600;
    }

    .slot-btn {
        padding: 10px 15px;
        border: 1px solid var(--border);
        border-radius: 10px;
        cursor: pointer;
        margin: 5px;
        display: inline-block;
        transition: 0.2s;
        background: white;
        font-weight: 500;
    }

    .slot-btn:hover {
        background: #eaf6ff;
        transform: scale(1.02);
    }

    .slot-btn.selected {
        background: linear-gradient(135deg, var(--accent-dark), var(--accent));
        color: white;
        border: none;
    }

    /* CONFIRM PANEL */
    .confirm-panel {
        margin-top: 20px;
    }

    .confirm-panel h3 {
        padding: 15px;
        border-bottom: 1px solid var(--border);
        font-weight: 600;
    }

    #summary {
        padding: 15px;
        min-height: 100px;
        line-height: 1.6;
    }

    .btn-confirm {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, var(--accent-dark), var(--accent));
        color: white;
        border: none;
        cursor: pointer;
        font-weight: 600;
        font-size: 1rem;
        transition: 0.3s;
    }

    .btn-confirm:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(58, 123, 213, 0.3);
    }

    .btn-confirm:disabled {
        background: #aaa;
        cursor: not-allowed;
    }

    /* MOBILE */
    @media (max-width: 900px) {
        .main-grid {
            grid-template-columns: 1fr;
        }
        
        .calendar-page {
            padding: 100px 5% 30px;
        }
        
        .doctor-banner {
            flex-direction: column;
            text-align: center;
        }
    }

    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .calendar-container, .time-slots, .confirm-panel {
        animation: fadeIn 0.5s ease-out;
    }
</style>
</head>

<body>

<!-- ANIMATED BACKGROUND -->
<div class="animated-bg">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
</div>

<nav>
    <div class="logo">Medi<span>Time</span></div>

    <div class="nav-links">
        <a href="{{ route('patient.dashboard') }}" class="btn-login">Accueil</a>

        <a href="{{ route('profile.edit') }}" class="btn-login">
            {{ auth()->user()->name }}
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn-login">Déconnexion</button>
        </form>
    </div>
</nav>

<section class="calendar-page">

    <!-- DOCTOR BANNER -->
    <div class="doctor-banner">
        <div class="doctor-avatar">
            <img src="{{ $medecin->photo ? asset('photos/' . $medecin->photo) : asset('images/default.png') }}" 
                 alt="Dr. {{ $medecin->name }}"
                 onerror="this.src='{{ asset('images/default.png') }}'">
        </div>

        <div>
            <h2>Dr. {{ $medecin->name }}</h2>
            <p>{{ $medecin->speciality ?? 'Spécialité non définie' }} · Consultation</p>
            @if($medecin->address)
                <p style="font-size: 12px; color: #6b7280; margin-top: 5px;">📍 {{ $medecin->address }}</p>
            @endif
            @if($medecin->phone)
                <p style="font-size: 12px; color: #6b7280;">📞 {{ $medecin->phone }}</p>
            @endif
        </div>
    </div>

    <div class="main-grid">

        <!-- CALENDAR -->
        <div class="calendar-container">
            <div class="calendar-header">
                <button onclick="changeMonth(-1)">← Mois précédent</button>
                <h3 id="monthYear"></h3>
                <button onclick="changeMonth(1)">Mois suivant →</button>
            </div>
            <div id="calendarDates" class="calendar-dates"></div>
        </div>

        <!-- RIGHT PANEL -->
        <div>
            <div class="time-slots">
                <h3>📅 Créneaux disponibles</h3>
                <div id="slots">Sélectionnez une date</div>
            </div>

            <div class="confirm-panel">
                <h3>📝 Résumé du rendez-vous</h3>
                <div id="summary">Aucun rendez-vous sélectionné</div>
                <button id="confirmBtn" class="btn-confirm" disabled>
                    ✅ Confirmer le rendez-vous
                </button>
            </div>
        </div>

    </div>
</section>

<script>
let currentDate = new Date();
let selectedDate = null;
let selectedSlot = null;

const slots = ["08:00","08:30","09:00","09:30","10:00","10:30","11:00","11:30","14:00","14:30","15:00","15:30","16:00","16:30"];

function renderCalendar() {
    const container = document.getElementById("calendarDates");
    container.innerHTML = "";

    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    document.getElementById("monthYear").innerText =
        currentDate.toLocaleString('fr-FR', { month: 'long', year: 'numeric' });

    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    let startOffset = firstDay === 0 ? 6 : firstDay - 1;

    for (let i = 0; i < startOffset; i++) {
        container.innerHTML += `<div></div>`;
    }

    const today = new Date();
    const todayDate = today.getDate();
    const todayMonth = today.getMonth();
    const todayYear = today.getFullYear();

    for (let d = 1; d <= daysInMonth; d++) {
        let isToday = (d === todayDate && month === todayMonth && year === todayYear);
        let todayClass = isToday ? 'today' : '';
        container.innerHTML += `
            <div class="cal-day ${todayClass}" onclick="selectDate(${d}, this)">
                ${d}
            </div>
        `;
    }
}

function changeMonth(i) {
    currentDate.setMonth(currentDate.getMonth() + i);
    renderCalendar();
    selectedDate = null;
    selectedSlot = null;
    document.getElementById("slots").innerHTML = "Sélectionnez une date";
    document.getElementById("summary").innerHTML = "Aucun rendez-vous sélectionné";
    document.getElementById("confirmBtn").disabled = true;
}

function selectDate(day, element) {
    selectedDate = day;
    
    document.querySelectorAll('.cal-day').forEach(el => {
        el.classList.remove('selected');
    });
    
    element.classList.add('selected');

    let html = '<div style="display: flex; flex-wrap: wrap; gap: 8px;">';
    slots.forEach(slot => {
        html += `<div class="slot-btn" onclick="selectSlot('${slot}', this)">🕐 ${slot}</div>`;
    });
    html += '</div>';
    document.getElementById("slots").innerHTML = html;
    
    selectedSlot = null;
    document.getElementById("summary").innerHTML = "Aucun rendez-vous sélectionné";
    document.getElementById("confirmBtn").disabled = true;
}

function selectSlot(time, element) {
    selectedSlot = time;
    
    document.querySelectorAll('.slot-btn').forEach(el => {
        el.classList.remove('selected');
    });
    
    element.classList.add('selected');

    const year = currentDate.getFullYear();
    const month = currentDate.getMonth() + 1;
    
    const weekdays = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    const dateObj = new Date(year, currentDate.getMonth(), selectedDate);
    const weekday = weekdays[dateObj.getDay()];
    
    document.getElementById("summary").innerHTML = `
        <strong style="color: var(--accent-dark);">👨‍⚕️ Dr. {{ $medecin->name }}</strong><br>
        📅 <strong>Date:</strong> ${weekday} ${selectedDate}/${month}/${year}<br>
        ⏰ <strong>Heure:</strong> ${time}<br>
        <hr style="margin: 10px 0; border-color: #eee;">
        <small style="color: #6b7280;">Cliquez sur "Confirmer" pour valider votre rendez-vous</small>
    `;
    document.getElementById("confirmBtn").disabled = false;
}

document.getElementById("confirmBtn")?.addEventListener('click', function() {
    if (selectedDate && selectedSlot) {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth() + 1;
        
        alert(`✅ Rendez-vous confirmé !\n\nDr. {{ $medecin->name }}\n📅 Date: ${selectedDate}/${month}/${year}\n⏰ Heure: ${selectedSlot}\n\nUn email de confirmation vous a été envoyé.`);
        
        // Désactiver le bouton après confirmation
        document.getElementById("confirmBtn").disabled = true;
        document.getElementById("confirmBtn").textContent = "✓ Rendez-vous confirmé";
    }
});

renderCalendar();
</script>

</body>
</html>