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

<h1 class="section-title">Mes rendez-vous</h1>

<table class="appointments-table">

<thead>
<tr>
<th>Médecin</th>
<th>Date</th>
<th>Heure</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach($appointments as $appointment)

<tr>

<td>Dr. {{ $appointment->doctor->name }}</td>

<td>{{ $appointment->date }}</td>

<td>{{ $appointment->time }}</td>

<td>

@if($appointment->status == 'pending')
<span class="status-pending">En attente</span>

@elseif($appointment->status == 'confirmed')
<span class="status-confirmed">Confirmé</span>

@elseif($appointment->status == 'rejected')
<span class="status-rejected">Refusé</span>

@endif

</td>

</tr>

@endforeach

</tbody>

</table>

</section>
   </body>
</html>