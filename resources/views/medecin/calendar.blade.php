<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calendrier | MediTime</title>

<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
:root {
  --bg: #eef2f3;
  --surface: #ffffff;
  --primary: #3a7bd5;
  --primary2: #00d2ff;
  --dark: #1e272e;
  --text: #1a2332;
  --border: #e5e7eb;
}

/* RESET */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'DM Sans', sans-serif;
}

body {
  background: var(--bg);
  color: var(--text);
}

/* NAVBAR (FIXED STYLE) */
nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 18px 8%;
  position: fixed;
  width: 100%;
  top: 0;
  left: 0;
  background: rgba(255,255,255,0.95);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid var(--border);
  z-index: 1000;
}

.logo {
  font-size: 22px;
  font-weight: 800;
}

.logo span {
  color: var(--primary);
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
}

.btn-login:hover {
  background: var(--primary);
}

/* PAGE */
.calendar-page {
  padding: 120px 8% 50px;
}

/* DOCTOR CARD */
.doctor-banner {
  background: white;
  padding: 18px;
  border-radius: 16px;
  border: 1px solid var(--border);
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 25px;
}

.doctor-avatar {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  overflow: hidden;
}

.doctor-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* GRID */
.main-grid {
  display: grid;
  grid-template-columns: 1fr 320px;
  gap: 20px;
}

/* CALENDAR */
.calendar-container,
.time-slots,
.confirm-panel {
  background: white;
  border: 1px solid var(--border);
  border-radius: 16px;
  overflow: hidden;
}

.calendar-header {
  display: flex;
  justify-content: space-between;
  padding: 12px;
  border-bottom: 1px solid var(--border);
}

.calendar-header button {
  background: var(--primary);
  color: white;
  border: none;
  padding: 6px 10px;
  border-radius: 6px;
  cursor: pointer;
}

.calendar-dates {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 6px;
  padding: 12px;
}

.cal-day {
  text-align: center;
  padding: 10px;
  border-radius: 8px;
  cursor: pointer;
  transition: 0.2s;
}

.cal-day:hover {
  background: #eaf6ff;
}

.cal-day.today {
  background: var(--primary2);
  color: white;
}

.cal-day.selected {
  background: var(--primary);
  color: white;
}

/* SLOTS */
.time-slots {
  padding: 10px;
}

.slot-btn {
  padding: 8px;
  border: 1px solid var(--border);
  border-radius: 8px;
  cursor: pointer;
  margin: 5px;
  display: inline-block;
}

.slot-btn.selected {
  background: var(--primary);
  color: white;
}

/* CONFIRM */
.btn-confirm {
  width: 100%;
  padding: 12px;
  background: var(--primary);
  color: white;
  border: none;
  cursor: pointer;
  border-radius: 0 0 16px 16px;
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
}
</style>
</head>

<body>

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

  <div class="doctor-banner">
    <div class="doctor-avatar">
      <img src="{{ asset('storage/' . $medecin->image) }}">
    </div>

    <div>
      <h2>Dr. {{ $medecin->name }}</h2>
      <p>{{ $medecin->speciality }} · Consultation</p>
    </div>
  </div>

  <div class="main-grid">

    <!-- CALENDAR -->
    <div class="calendar-container">

      <div class="calendar-header">
        <button onclick="changeMonth(-1)">←</button>
        <h3 id="monthYear"></h3>
        <button onclick="changeMonth(1)">→</button>
      </div>

      <div id="calendarDates" class="calendar-dates"></div>
    </div>

    <!-- RIGHT PANEL -->
    <div>

      <div class="time-slots">
        <h3>Créneaux</h3>
        <div id="slots">Sélectionnez une date</div>
      </div>

      <div class="confirm-panel" style="margin-top:15px;">
        <h3 style="padding:10px;">Résumé</h3>
        <div id="summary" style="padding:10px;">Aucun rendez-vous</div>

        <button class="btn-confirm" disabled>
          Confirmer
        </button>
      </div>

    </div>

  </div>

</section>

<script>
let currentDate = new Date();
let selectedDate = null;
let selectedSlot = null;

const slots = ["08:00","08:30","09:00","09:30","10:00","10:30"];

function renderCalendar() {
  const container = document.getElementById("calendarDates");
  container.innerHTML = "";

  const year = currentDate.getFullYear();
  const month = currentDate.getMonth();

  document.getElementById("monthYear").innerText =
    currentDate.toLocaleString('fr-FR', { month:'long', year:'numeric' });

  const firstDay = new Date(year, month, 1).getDay();
  const days = new Date(year, month+1, 0).getDate();

  for (let i = 0; i < firstDay; i++) {
    container.innerHTML += `<div></div>`;
  }

  for (let d = 1; d <= days; d++) {
    container.innerHTML += `
      <div class="cal-day" onclick="selectDate(${d})">
        ${d}
      </div>
    `;
  }
}

function changeMonth(i) {
  currentDate.setMonth(currentDate.getMonth() + i);
  renderCalendar();
}

function selectDate(day) {
  selectedDate = day;

  document.querySelectorAll('.cal-day').forEach(el => {
    el.classList.remove('selected');
  });

  event.target.classList.add('selected');

  let html = "";
  slots.forEach(s => {
    html += `<div class="slot-btn" onclick="selectSlot('${s}')">${s}</div>`;
  });

  document.getElementById("slots").innerHTML = html;
}

function selectSlot(time) {
  selectedSlot = time;

  document.getElementById("summary").innerHTML =
    `Dr {{ $medecin->name }}<br>Date: ${selectedDate}<br>Heure: ${time}`;
}

renderCalendar();
</script>

</body>
</html>