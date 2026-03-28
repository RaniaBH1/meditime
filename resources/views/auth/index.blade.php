<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediTime | Réservation Rapide</title>
    
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
        <a href="/" class="btn-login">Accueil</a>
        <a href="/login" class="btn-login">Se connecter</a>
    </div>
</nav>
</nav>


    <section class="hero">
        <div class="hero-text">
            <h1 class="reveal">Votre santé, <br><span>en un clic.</span></h1>
            <p class="reveal-delay">Accédez instantanément aux disponibilités des spécialistes proches de chez vous.</p>
            
            <div class="search-box">
                <input type="text" id="doctorInput" placeholder="Rechercher une spécialité...">
                <button id="searchBtn">Trouver</button>
            </div>
        </div>

<!-- test comment -->

        
        <div class="hero-visual">
            <div class="card" id="interactiveCard">
                <div class="video-wrapper">
                    <video class="doc-vid" autoplay loop muted playsinline>
                        <source src="Les Conseils du Docteur Hibou_720p_caption.mp4" type="video/mp4">
                    </video>
                </div>

                <div class="card-action">
                    <button class="confirm-btn" id="bookBtn" onclick="window.location.href='{{ url('/contact') }}'">
    Contactez-nous
</button>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>