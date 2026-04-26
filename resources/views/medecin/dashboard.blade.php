<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Médecin | MediTime</title>

@vite(['resources/css/app.css','resources/js/app.js'])

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

@include('layouts.global-css')

</head>


<body>

<div class="background-blobs">
<div class="blob blob-1"></div>
<div class="blob blob-2"></div>
</div>


<nav>

<div class="logo">Medi<span>Time</span></div>

<div class="nav-links">

<a href="{{ route('medecin.dashboard') }}" class="btn-login">
Accueil
</a>

<a href="{{ route('profile.edit') }}" class="btn-login"
style="background:white;color:var(--dark);border:1px solid #e5e7eb;">
{{ auth()->user()->name }}
</a>

<form method="POST" action="{{ route('logout') }}">
@csrf
<button class="btn-login btn-signup">
Déconnexion
</button>
</form>

</div>

</nav>



<section class="dashboard-page">

<h1 class="section-title">
Bienvenue Dr. <span>{{ auth()->user()->name }}</span>
</h1>

<p class="section-subtitle">
Gérez votre activité médicale, vos horaires et vos rendez-vous.
</p>


<div class="dashboard-grid">


<!-- RENDEZ VOUS -->

<div class="dashboard-card">

<h3>Mes rendez-vous</h3>

<p> Ma Calendreier </p>
<br>



<div class="dashboard-actions">

<a href="{{ route('doctor.calendar') }}" class="dashboard-btn">Consulter</a>

</div>

</div>



<!-- DISPONIBILITES -->

<div class="dashboard-card">

<h3>Disponibilités</h3>

<p>Créneaux disponibles configurés.</p>
<br>

<div class="dashboard-actions">

<a href="{{ route('medecin.disponibilites') }}" class="dashboard-btn">
Gérer
</a>

</div>

</div>



<!-- PENDING -->

<div class="dashboard-card">

<h3>Demandes en attente</h3>

<p>Patients attendant confirmation.</p>

<div class="dashboard-stat">
{{ $pendingCount }}
</div>

<div class="dashboard-actions">

<a href="{{ route('doctor.appointments') }}" class="dashboard-btn">
Voir
</a>

</div>

</div>


</div>



<!-- TODAY APPOINTMENTS -->

<div style="margin-top:40px">

<h2 style="margin-bottom:15px">
📅 Rendez-vous aujourd'hui
</h2>

<div class="dashboard-card">

@if($todayAppointments->isEmpty())

<p>Aucun rendez-vous aujourd'hui.</p>

@else

@foreach($todayAppointments as $app)

<div class="appointment-row">

<span class="time">
⏰ {{ $app->time }}
</span>

<span class="patient">
👤 {{ $app->patient->name }}
</span>

<span class="status 
@if($app->status=='pending') pending
@elseif($app->status=='confirmed') confirmed
@endif
">

{{ ucfirst($app->status) }}

</span>

</div>

@endforeach

@endif

</div>

</div>



</section>


<style>

.appointment-row{
display:flex;
justify-content:space-between;
padding:10px;
border-bottom:1px solid #eee;
}

.status{
font-weight:600;
}

.status.pending{
color:orange;
}

.status.confirmed{
color:green;
}

</style>


</body>
</html>