<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Calendrier | MediTime</title>

@vite(['resources/css/app.css','resources/js/app.js'])
@include('layouts.global-css')

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>

body{
background:#eef2f3;
font-family:'Poppins',sans-serif;
padding-top:90px;
}

/* NAVBAR */

nav{
display:flex;
justify-content:space-between;
align-items:center;
padding:18px 8%;
position:fixed;
top:0;
left:0;
width:100%;
background:white;
border-bottom:1px solid #e5e7eb;
z-index:1000;
}

.logo{
font-size:22px;
font-weight:800;
}

.logo span{
color:#3a7bd5;
}

.nav-links{
display:flex;
gap:12px;
align-items:center;
}

.btn-login{
padding:10px 18px;
border-radius:30px;
text-decoration:none;
background:#1e272e;
color:white;
font-weight:600;
border:none;
cursor:pointer;
}

/* PAGE */


.calendar-page{
width: 100%;
max-width:none;
padding:30px 60px;
}

/* GRID */

.main-grid{
display:grid;
grid-template-columns: 4fr 2fr;
gap:30px;
width:100%;
max-width:1300px;
margin:auto;
}

/* CALENDAR */

.calendar-container{
width:100%;
min-width:900px;
background:white;
border-radius:16px;
border:1px solid #e5e7eb;
overflow:hidden;
}

.calendar-header{
display:flex;
justify-content:space-between;
align-items:center;
padding:15px;
background:linear-gradient(135deg,#3a7bd5,#00d2ff);
color:white;
}

.calendar-header button{
background:rgba(255,255,255,0.2);
border:none;
padding:6px 12px;
border-radius:20px;
cursor:pointer;
color:white;
}

.calendar-dates{
display:grid;
grid-template-columns:repeat(7,1fr);
gap:10px;
padding:20px;
width:100%;
}

.cal-day{
min-height:110px;
font-size:16px;
padding:10px;
border-radius:10px;
background:#f9fafb;
display:flex;
flex-direction:column;
align-items:flex-start;
justify-content:flex-start;
gap:6px;
cursor:pointer;
}

.cal-day:hover{
background:#eaf6ff;
}

.cal-day.selected{
background:#3a7bd5;
color:white;
}

/* APPOINTMENT STYLE */

.appointment{
font-size:11px;
padding:2px 4px;
border-radius:6px;
}

.app-confirmed{
background:#2563eb;
color:white;
}

.app-pending{
background:#f59e0b;
color:white;
}

/* RIGHT PANEL */

.time-slots,
.confirm-panel{
background:white;
border:1px solid #e5e7eb;
border-radius:16px;
padding:15px;
margin-bottom:15px;
}

.slot-btn{
padding:8px 12px;
border:1px solid #e5e7eb;
border-radius:8px;
cursor:pointer;
background:white;
}

.appointment-dot-confirmed{
width:8px;
height:8px;
background:#22c55e;
border-radius:50%;
margin-top:6px;
}

.appointment-dot-pending{
width:8px;
height:8px;
background:#facc15;
border-radius:50%;
margin-top:6px;
}

.slot-btn.selected{
background:#3a7bd5;
color:white;
}

.btn-confirm{
width:100%;
padding:12px;
border:none;
background:#3a7bd5;
color:white;
border-radius:8px;
cursor:pointer;
}

.calendar-weekdays{
display:grid;
grid-template-columns:repeat(7,1fr);
padding:10px 20px;
background:#f3f4f6;
border-bottom:1px solid #e5e7eb;
font-weight:600;
text-align:center;
color:#374151;
}

/* MOBILE */

@media(max-width:900px){

.main-grid{
grid-template-columns:1fr;
}

}

</style>

</head>

<body>

<nav>

<div class="logo">Medi<span>Time</span></div>

<div class="nav-links">

<a href="{{ auth()->user()->role === 'medecin' ? route('medecin.dashboard') : route('patient.dashboard') }}" class="btn-login">Accueil</a>

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

<div class="main-grid">

<!-- CALENDAR -->

<div class="calendar-container">

<div class="calendar-header">

<button onclick="changeMonth(-1)">←</button>

<h3 id="monthYear"></h3>

<button onclick="changeMonth(1)">→</button>

</div>

<div class="calendar-weekdays">
<div>Lun</div>
<div>Mar</div>
<div>Mer</div>
<div>Jeu</div>
<div>Ven</div>
<div>Sam</div>
<div>Dim</div>
</div>

<div id="calendarDates" class="calendar-dates"></div>

</div>


<div>

@if($doctorMode ?? false)

<div class="time-slots">

<h3>📅 Rendez-vous du jour</h3>

<div id="dayAppointments">
Cliquez sur une date pour voir les rendez-vous
</div>

</div>

@else

<div class="time-slots">

<h3>📅 Créneaux disponibles</h3>

<div id="slots">Sélectionnez une date</div>

</div>

<div class="confirm-panel">

<h3>📝 Résumé</h3>

<div id="summary">Aucun rendez-vous sélectionné</div>

<button id="confirmBtn" class="btn-confirm" disabled>
Confirmer rendez-vous
</button>

</div>

@endif


</div>


@if(!($doctorMode ?? false) && isset($medecin))

<form id="appointmentForm" method="POST" action="{{ route('appointments.store') }}">

@csrf

<input type="hidden" name="doctor_id" value="{{ $medecin->id }}">

<input type="hidden" name="date" id="appointmentDate">

<input type="hidden" name="time" id="appointmentTime">

</form>

@endif


</section>


<script>


let doctorMode = @json($doctorMode ?? false);
let appointments = @json($appointments ?? []);

let currentDate = new Date();
let selectedDate = null;
let selectedSlot = null;

const doctorId = @json($medecin->id ?? null);


function renderCalendar(){

const container = document.getElementById("calendarDates");
container.innerHTML = "";

const year = currentDate.getFullYear();
const month = currentDate.getMonth();

document.getElementById("monthYear").innerText =
currentDate.toLocaleString('fr-FR',{month:'long',year:'numeric'});

const firstDay = new Date(year,month,1).getDay();
const daysInMonth = new Date(year,month+1,0).getDate();

let startOffset = firstDay === 0 ? 6 : firstDay - 1;

for(let i=0;i<startOffset;i++){
container.innerHTML += `<div></div>`;
}

for(let d=1; d<=daysInMonth; d++){

if(doctorMode){

let dateString=`${year}-${String(month+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
let dayAppointments = appointments.filter(a => a.date === dateString);

let hasConfirmed = dayAppointments.some(a => a.status === "confirmed");
let hasPending = dayAppointments.some(a => a.status === "pending");

let dot = "";

if(hasConfirmed){
dot = `<div class="appointment-dot-confirmed"></div>`;
}
else if(hasPending){
dot = `<div class="appointment-dot-pending"></div>`;
}

container.innerHTML += `
<div class="cal-day" onclick="selectDoctorDay(${d})">
<strong>${d}</strong>
${dot}
</div>
`;

}else{

container.innerHTML += `
<div class="cal-day" onclick="selectDate(${d},this)">
${d}
</div>
`;

}

}

}

function changeMonth(i){
currentDate.setMonth(currentDate.getMonth()+i);
renderCalendar();
}

function selectDate(day,element){

if(doctorMode) return;

selectedDate = day;

document.querySelectorAll(".cal-day").forEach(el=>el.classList.remove("selected"));
element.classList.add("selected");

const year = currentDate.getFullYear();
const month = currentDate.getMonth()+1;

const date =
`${year}-${month.toString().padStart(2,'0')}-${day.toString().padStart(2,'0')}`;

document.getElementById("appointmentDate").value = date;

loadAvailableSlots(date);

}

function loadAvailableSlots(date){

const container = document.getElementById("slots");
container.innerHTML = "Chargement...";

const url = "{{ url('/doctor') }}/" + doctorId + "/available-slots?date=" + date;

console.log("Fetching:", url);

fetch(url)
.then(res => {

if(!res.ok){
throw new Error("HTTP " + res.status);
}

return res.json();

})
.then(slots => {

container.innerHTML = "";

if(slots.length === 0){
container.innerHTML = "<p>Aucun créneau disponible</p>";
return;
}

slots.forEach(time => {

let btn = document.createElement("div");
btn.className = "slot-btn";
btn.innerText = time;

btn.onclick = function(){

selectedSlot = time;

document.querySelectorAll(".slot-btn")
.forEach(el => el.classList.remove("selected"));

btn.classList.add("selected");

document.getElementById("appointmentTime").value = time;

document.getElementById("confirmBtn").disabled = false;

/* UPDATE SUMMARY */

const year = currentDate.getFullYear();
const month = currentDate.getMonth()+1;

const date =
`${year}-${month.toString().padStart(2,'0')}-${selectedDate.toString().padStart(2,'0')}`;

document.getElementById("summary").innerHTML = `
<b>Date :</b> ${date}<br>
<b>Heure :</b> ${time}
`;

};

container.appendChild(btn);

});

})
.catch(err => {

console.error(err);
container.innerHTML = "Erreur chargement créneaux";

});

}

function selectDoctorDay(day){

if(!doctorMode) return;

const year=currentDate.getFullYear();
const month=currentDate.getMonth()+1;

const date=
`${year}-${month.toString().padStart(2,'0')}-${day.toString().padStart(2,'0')}`;

const container=document.getElementById("dayAppointments");

let dayApps = appointments.filter(a =>
    a.date === date && a.status !== "rejected"
);

if(dayApps.length===0){
container.innerHTML="<p>Aucun rendez-vous ce jour.</p>";
return;
}

let html="";

dayApps.forEach(app=>{

let color = app.status==="confirmed" ? "#2563eb" : "#f59e0b";

html += `
<div style="padding:10px;border-bottom:1px solid #eee">

⏰ ${app.time}
<br>

👤 ${app.patient.name}
<br>

<span style="color:${color};font-weight:600">
${app.status}
</span>

</div>
`;

});

container.innerHTML = html;

}
const confirmBtn = document.getElementById("confirmBtn");

if(confirmBtn){

confirmBtn.addEventListener("click", function(){

if(!selectedDate || !selectedSlot){
alert("Veuillez sélectionner une date et un créneau.");
return;
}

fetch("{{ route('appointments.store') }}",{

method:"POST",

headers:{
"Content-Type":"application/json",
"X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute('content')
},

body:JSON.stringify({
doctor_id:doctorId,
date:document.getElementById("appointmentDate").value,
time:document.getElementById("appointmentTime").value
})

})

.then(res=>res.json())
.then(data=>{

showConfirmationPopup();

loadAvailableSlots(document.getElementById("appointmentDate").value);

document.getElementById("confirmBtn").disabled=true;

});

});

}
function showConfirmationPopup(){

const date=document.getElementById("appointmentDate").value;
const time=document.getElementById("appointmentTime").value;

document.getElementById("popupDetails").innerHTML=
`
📅 ${date}<br>
⏰ ${time}<br><br>
⏳ En attente de confirmation du médecin
`;

document.getElementById("bookingPopup").style.display="block";

}

function closePopup(){
document.getElementById("bookingPopup").style.display="none";
}
renderCalendar();



</script>

<div id="bookingPopup" style="
position:fixed;
top:50%;
left:50%;
transform:translate(-50%,-50%);
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 10px 40px rgba(0,0,0,0.2);
display:none;
z-index:9999;
text-align:center;
">

<h2 style="color:#16a34a;">✔ Rendez-vous envoyé</h2>

<p id="popupDetails"></p>

<button onclick="closePopup()" style="
margin-top:15px;
padding:10px 20px;
background:#3a7bd5;
color:white;
border:none;
border-radius:8px;
cursor:pointer;
">

Fermer

</button>

</div>
</body>
</html>