<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Disponibilités | MediTime</title>

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

<h1 class="section-title">Mes disponibilités</h1>

<!-- ADD AVAILABILITY -->

<form method="POST"
action="{{ route('medecin.disponibilites.store') }}"
class="availability-form">

@csrf

<select name="day_of_week" required>

<option value="">Choisir un jour</option>

<option value="monday">Lundi</option>
<option value="tuesday">Mardi</option>
<option value="wednesday">Mercredi</option>
<option value="thursday">Jeudi</option>
<option value="friday">Vendredi</option>
<option value="saturday">Samedi</option>
<option value="sunday">Dimanche</option>

</select>


<div id="slots-container">

<div class="slot-row">

<input type="time" name="start_time[]" required>
<input type="time" name="end_time[]" required>

</div>

</div>


<button type="button" onclick="addSlot()" class="dashboard-btn">
+ Ajouter un créneau
</button>


<button type="submit" class="dashboard-btn">
Enregistrer
</button>

</form>



<h3 style="margin-top:30px">Créneaux existants</h3>

@if($slots->isEmpty())

<p>Aucun créneau enregistré.</p>

@else

@foreach($slots as $slot)

<div class="availability-slot">

<strong>{{ ucfirst($slot->day_of_week) }}</strong>

<span>
{{ $slot->start_time }} → {{ $slot->end_time }}
</span>

<form method="POST"
action="{{ route('medecin.disponibilites.delete',$slot->id) }}">

@csrf
@method('DELETE')

<button class="dashboard-btn">
Supprimer
</button>

</form>

</div>

@endforeach

@endif


</section>


<script>

function addSlot(){

const container = document.getElementById("slots-container");

const div = document.createElement("div");

div.classList.add("slot-row");

div.innerHTML = `
<input type="time" name="start_time[]" required>
<input type="time" name="end_time[]" required>
`;

container.appendChild(div);

}

</script>


</body>
</html>