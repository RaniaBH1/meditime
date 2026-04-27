<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediTime | Réservation Rapide</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @include('layouts.global-css')
</head>
<body>

<!-- ANIMATED BACKGROUND -->
<div class="animated-bg">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="shape circle"></div>
    <div class="shape triangle"></div>
    <div class="shape square"></div>
</div>

<!-- NAVIGATION -->
<nav>
    <div class="logo">Medi<span>Time</span></div>
    <div class="nav-links">
        <a href="/" class="btn-login">Accueil</a>
        <a href="/login" class="btn-login btn-signup">Se connecter</a>
    </div>
</nav>

<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-text reveal">
        <div class="welcome-badge">🏥 Votre plateforme médicale de confiance</div>
        <h1>Votre santé,<br><span>en un clic.</span></h1>
        <p>Accédez instantanément aux disponibilités des spécialistes proches de chez vous. Prenez rendez-vous en quelques secondes, sans attente.</p>
        <div class="search-box" style="position:relative;">
            <input type="text" id="specialtyInput" placeholder="Rechercher une spécialité..." autocomplete="off" />
            <button onclick="searchSpecialty()">Trouver</button>
            <div class="autocomplete-items" id="autocomplete-list" style="top:100%;left:0;display:none;"></div>
        </div>
        <div id="results"></div>
    </div>

    <div class="hero-visual reveal-delay">
        <div class="card" id="heroCard">
            <div class="video-wrapper">
                <video class="doc-vid" autoplay loop muted playsinline>
                    <source src="{{ asset('Les Conseils du Docteur Hibou_720p_caption.mp4') }}" type="video/mp4">
                </video>
            </div>
            <div class="card-action">
                <button class="confirm-btn" onclick="window.location.href='{{ url('/contact') }}'">Contactez-nous</button>
            </div>
        </div>
    </div>
</section>

<!-- STATS SECTION -->
<section class="stats-section">
    <div class="stats-grid">
        <div class="stat-item"><div class="stat-number">500+</div><div class="stat-label">Médecins partenaires</div></div>
        <div class="stat-item"><div class="stat-number">50K+</div><div class="stat-label">Patients satisfaits</div></div>
        <div class="stat-item"><div class="stat-number">30+</div><div class="stat-label">Spécialités médicales</div></div>
        <div class="stat-item"><div class="stat-number">24/7</div><div class="stat-label">Disponible en ligne</div></div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="how-section" id="how">
    <div class="section-header">
        <div class="section-tag">Simple & rapide</div>
        <h2>Comment fonctionne <span class="meditime-gradient">MediTime</span> ?</h2>
        <p>Prenez rendez-vous avec un professionnel de santé en 3 étapes simples.</p>
    </div>
    <div class="steps-grid">
        <div class="step-card">
            <div class="step-icon"><i class="fas fa-search"></i></div>
            <div class="step-number">01</div>
            <h3>Recherchez</h3>
            <p>Entrez votre spécialité ou le nom d'un médecin. Filtrez par ville, disponibilité ou tarif.</p>
        </div>
        <div class="step-connector">→</div>
        <div class="step-card">
            <div class="step-icon"><i class="fas fa-calendar-check"></i></div>
            <div class="step-number">02</div>
            <h3>Choisissez</h3>
            <p>Consultez les profils détaillés et les créneaux disponibles en temps réel.</p>
        </div>
        <div class="step-connector">→</div>
        <div class="step-card">
            <div class="step-icon"><i class="fas fa-check-circle"></i></div>
            <div class="step-number">03</div>
            <h3>Confirmez</h3>
            <p>Recevez une confirmation instantanée par SMS et email. Aucune attente.</p>
        </div>
    </div>
</section>

<!-- SPECIALTIES SECTION -->
<section class="specialties-section" id="specialties">
    <div class="section-header">
        <div class="section-tag">Nos expertises</div>
        <h2><span class="specialite-blue">Spécialité</span> ou compétence<br>du médecin</h2>
        <p>Découvrez et réservez vos rendez-vous avec les meilleurs médecins près de chez vous.</p>
    </div>
    <div class="specialties-carousel-wrapper">
        <button class="carousel-btn prev-btn" onclick="slideSpecialties(-1)">&#8249;</button>
        <div class="specialties-carousel" id="specialtiesCarousel">
            <div class="specialty-card"><div class="specialty-icon"><i class="fas fa-heartbeat"></i></div><span>Cardiologie</span></div>
            <div class="specialty-card"><div class="specialty-icon"><i class="fas fa-allergies"></i></div><span>Dermatologie</span></div>
            <div class="specialty-card"><div class="specialty-icon"><i class="fas fa-apple-alt"></i></div><span>Diététique et<br>Nutrition équilibrée</span></div>
            <div class="specialty-card"><div class="specialty-icon"><i class="fas fa-tachometer-alt"></i></div><span>Endocrinologie</span></div>
            <div class="specialty-card"><div class="specialty-icon"><i class="fas fa-stethoscope"></i></div><span>Gastro-entérologie</span></div>
            <div class="specialty-card"><div class="specialty-icon"><i class="fas fa-user-md"></i></div><span>Gériatrie</span></div>
            <div class="specialty-card"><div class="specialty-icon"><i class="fas fa-brain"></i></div><span>Neurologie</span></div>
            <div class="specialty-card"><div class="specialty-icon"><i class="fas fa-eye"></i></div><span>Ophtalmologie</span></div>
            <div class="specialty-card"><div class="specialty-icon"><i class="fas fa-tooth"></i></div><span>Dentisterie</span></div>
            <div class="specialty-card"><div class="specialty-icon"><i class="fas fa-ribbon"></i></div><span>Oncologie</span></div>
        </div>
        <button class="carousel-btn next-btn" onclick="slideSpecialties(1)">&#8250;</button>
    </div>
</section>

<!-- FAQ SECTION -->
<section class="faq-section" id="faq">
    <div class="section-header">
        <div class="section-tag">Aide</div>
        <h2 style="color:#3a4466;">FAQ</h2>
    </div>
    <div class="faq-container">
        <div class="faq-item" onclick="toggleFAQ(this)">
            <div class="faq-question"><span>Comment puis-je prendre rendez-vous avec un médecin ou professionnel de santé ?</span><div class="faq-icon">+</div></div>
            <div class="faq-answer">Utilisez la barre de recherche pour trouver un spécialiste. Sélectionnez un créneau et confirmez. Confirmation immédiate par email et SMS.</div>
        </div>
        <div class="faq-item" onclick="toggleFAQ(this)">
            <div class="faq-question"><span>Dois-je créer un compte pour réserver un rendez-vous ?</span><div class="faq-icon">+</div></div>
            <div class="faq-answer">Oui, création rapide pour gérer vos rendez-vous et historique.</div>
        </div>
        <div class="faq-item" onclick="toggleFAQ(this)">
            <div class="faq-question"><span>Puis-je annuler ou modifier mon rendez-vous ?</span><div class="faq-icon">+</div></div>
            <div class="faq-answer">Oui, jusqu'à 24h avant via votre espace personnel.</div>
        </div>
        <div class="faq-item" onclick="toggleFAQ(this)">
            <div class="faq-question"><span>Est-ce que MediTime est gratuit pour les patients ?</span><div class="faq-icon">+</div></div>
            <div class="faq-answer">Oui, totalement gratuit. Vous réglez uniquement la consultation.</div>
        </div>
    </div>
</section>

<!-- CONTACT SECTION -->
<section class="contact-section" id="contact">
    <div class="contact-wrapper">
        <div class="contact-info">
            <div class="section-tag">Contactez-nous</div>
            <h2>Une question ?<br>Nous sommes <span>là pour vous.</span></h2>
            <p>Notre équipe est disponible du lundi au vendredi de 8h à 18h.</p>
            <div class="contact-details">
                <div class="contact-item"><div class="contact-icon">📧</div><div><strong>Email</strong><p>support@meditime.tn</p></div></div>
                <div class="contact-item"><div class="contact-icon">📞</div><div><strong>Téléphone</strong><p>+216 71 000 000</p></div></div>
                <div class="contact-item"><div class="contact-icon">📍</div><div><strong>Adresse</strong><p>Tunis, Tunisie</p></div></div>
            </div>
        </div>
        <div class="contact-form-card">
            <h3>Envoyez-nous un message</h3>
            <div class="form-group"><input type="text" placeholder="Nom complet" class="form-input" /></div>
            <div class="form-group"><input type="email" placeholder="Email" class="form-input" /></div>
            <div class="form-group"><textarea placeholder="Message..." class="form-input form-textarea"></textarea></div>
            <button class="confirm-btn">Envoyer le message 📨</button>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-top">
        <div class="footer-brand">
            <div class="logo" style="color:white;">Medi<span>Time</span></div>
            <p>La plateforme médicale qui connecte patients et professionnels de santé en Tunisie.</p>
            <div class="social-links">
                <a href="#" class="social-link">f</a>
                <a href="#" class="social-link">in</a>
                <a href="#" class="social-link">▶</a>
                <a href="#" class="social-link">ig</a>
            </div>
        </div>
        <div class="footer-col"><h4>Menu</h4><a href="#">Médecin</a><a href="#">Professionnels de santé</a><a href="#">Spécialités</a><a href="#">Comment ça marche</a></div>
        <div class="footer-col"><h4>Mentions Légales</h4><a href="#">Politiques de confidentialité</a><a href="#">Conditions générales</a><a href="#">INPDP Autorisation N° 19/02-4264</a></div>
        <div class="footer-col"><h4>Contact</h4><a href="#">support@meditime.tn</a><a href="#">+216 71 000 000</a><a href="#">Tunis, Tunisie</a></div>
    </div>
    <div class="footer-bottom">
        <p>Ce site propose aux patients la possibilité de prendre des rendez-vous avec les médecins. Aucune téléconsultation.</p>
        <p class="footer-copy">© 2025 MediTime — Tous droits réservés</p>
    </div>
</footer>

<style>
    :root {
        --accent: #00d2ff;
        --accent-dark: #3a7bd5;
        --dark: #1e272e;
        --glass: rgba(255, 255, 255, 0.5);
        --teal: #00b4a0;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
    body { background: #eef2f3; min-height: 100vh; overflow-x: hidden; color: var(--dark); position: relative; }

    /* Animated background */
    .animated-bg { position: fixed; width: 100vw; height: 100vh; top: 0; left: 0; z-index: -2; pointer-events: none; }
    .blob { position: absolute; filter: blur(60px); border-radius: 50%; animation: float 15s infinite alternate ease-in-out; opacity: 0.35; }
    .blob-1 { width: 400px; height: 400px; background: var(--accent); top: -10%; right: -5%; }
    .blob-2 { width: 450px; height: 450px; background: var(--accent-dark); bottom: -10%; left: -5%; }
    @keyframes float { 0% { transform: translate(0,0); } 100% { transform: translate(-30px,30px); } }
    .shape { position: absolute; background: rgba(58,123,213,0.1); z-index: -2; }
    .circle { width: 100px; height: 100px; border-radius: 50%; top: 20%; left: 10%; }
    .triangle { width: 0; height: 0; border-left: 50px solid transparent; border-right: 50px solid transparent; border-bottom: 80px solid rgba(0,210,255,0.1); top: 70%; left: 80%; background: transparent; }
    .square { width: 90px; height: 90px; top: 18%; right: 12%; border-radius: 18px; transform: rotate(20deg); background: rgba(58,123,213,0.08); }

    /* Nav */
    nav { display: flex; justify-content: space-between; align-items: center; padding: 30px 8%; position: fixed; width: 100%; top: 0; left: 0; background: rgba(255,255,255,0.95); box-shadow: 0 2px 10px rgba(0,0,0,0.1); z-index: 200; }
    .logo { font-size: 1.6rem; font-weight: 800; }
    .logo span { color: var(--accent-dark); }
    .nav-links { display: flex; gap: 15px; align-items: center; }
    .btn-login { background: var(--dark); color: white; text-decoration: none; padding: 12px 25px; border-radius: 50px; font-weight: 600; white-space: nowrap; transition: 0.3s; display: inline-flex; align-items: center; }
    .btn-login:hover { background: var(--accent-dark); transform: translateY(-2px); }
    .btn-signup { background: var(--accent-dark); }

    /* Hero */
    .hero { display: flex; align-items: center; justify-content: space-between; padding: 140px 8% 80px 8%; gap: 50px; min-height: 90vh; }
    .hero-text { flex: 1; }
    .hero-text h1 { font-size: 3.8rem; line-height: 1.1; margin-bottom: 20px; }
    .hero-text h1 span { background: linear-gradient(90deg, var(--accent), var(--accent-dark)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    .hero-text p { font-size: 1.1rem; color: #4b5563; margin-bottom: 18px; line-height: 1.6; max-width: 650px; }
    .welcome-badge { display: inline-block; margin-bottom: 24px; padding: 10px 18px; background: rgba(255,255,255,0.8); border: 1px solid rgba(255,255,255,0.8); border-radius: 999px; box-shadow: 0 8px 20px rgba(0,0,0,0.06); font-weight: 600; font-size: 0.9rem; }
    .search-box { display: flex; align-items: center; gap: 10px; background: white; padding: 8px 10px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); width: 100%; max-width: 500px; position: relative; }
    .search-box input { flex: 1; border: none; outline: none; padding: 12px 15px; font-size: 1rem; border-radius: 10px; background: transparent; }
    .search-box button { padding: 12px 20px; border: none; background: var(--accent-dark); color: white; font-weight: 600; border-radius: 10px; cursor: pointer; transition: 0.3s; }
    .search-box button:hover { background: var(--accent); }
    .autocomplete-items { position: absolute; border: 1px solid #ddd; max-height: 150px; overflow-y: auto; background: #fff; width: 100%; border-radius: 0 0 10px 10px; z-index: 150; top: 100%; left: 0; }
    .autocomplete-items div { padding: 10px; cursor: pointer; }
    .autocomplete-items div:hover { background: #e9e9e9; }
    #results { margin-top: 10px; max-height: 250px; overflow-y: auto; display: flex; flex-direction: column; gap: 10px; max-width: 500px; }
    .doctor-card { display: flex; align-items: center; gap: 12px; padding: 10px 12px; border: 1px solid #ccc; border-radius: 12px; background: #fff; cursor: pointer; transition: 0.2s; }
    .doctor-card:hover { transform: scale(1.02); box-shadow: 0 6px 18px rgba(0,0,0,0.1); border-color: var(--accent-dark); }
    .hero-visual { flex: 0 0 auto; }
    .card { background: var(--glass); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.6); width: 350px; border-radius: 30px; overflow: hidden; box-shadow: 0 25px 50px rgba(0,0,0,0.15); transition: transform 0.3s ease; }
    .card:hover { transform: translateY(-8px); }
    .video-wrapper { width: 100%; height: 350px; background: #000; }
    .doc-vid { width: 100%; height: 100%; object-fit: cover; object-position: top; }
    .card-action { padding: 25px; }
    .confirm-btn { width: 100%; padding: 18px; border-radius: 20px; border: none; background: var(--dark); color: white; font-size: 1.1rem; font-weight: 700; cursor: pointer; transition: 0.3s; }
    .confirm-btn:hover { background: #000; transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }

    /* Animations */
    .reveal { animation: fadeIn 0.8s ease-out forwards; }
    .reveal-delay { animation: fadeIn 1s ease-out forwards; opacity: 0; animation-delay: 0.3s; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

    /* Stats */
    .stats-section { background: linear-gradient(135deg, var(--accent-dark), var(--accent)); padding: 60px 8%; margin: 0; }
    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; text-align: center; }
    .stat-item { color: white; }
    .stat-number { font-size: 3rem; font-weight: 800; line-height: 1; }
    .stat-label { font-size: 0.95rem; opacity: 0.85; margin-top: 8px; }

    /* Section commune */
    .section-header { text-align: center; margin-bottom: 60px; }
    .section-tag { display: inline-block; background: linear-gradient(90deg, rgba(0,210,255,0.15), rgba(58,123,213,0.15)); color: var(--accent-dark); padding: 6px 18px; border-radius: 999px; font-size: 0.85rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 16px; border: 1px solid rgba(58,123,213,0.2); }
    .section-header h2 { font-size: 2.5rem; font-weight: 800; color: var(--dark); margin-bottom: 16px; }
    .section-header p { font-size: 1rem; color: #6b7280; max-width: 550px; margin: 0 auto; }

    /* Dégradé MediTime */
    .meditime-gradient { background: linear-gradient(135deg, var(--accent-dark), var(--accent)); -webkit-background-clip: text; background-clip: text; color: transparent; }
    .specialite-blue { color: var(--accent-dark); }

    /* How it works */
    .how-section { padding: 100px 8%; background: white; }
    .steps-grid { display: flex; align-items: center; justify-content: center; gap: 20px; flex-wrap: wrap; }
    .step-card { background: #f8faff; border: 1px solid rgba(58,123,213,0.12); border-radius: 28px; padding: 40px 35px; text-align: center; flex: 1; min-width: 220px; max-width: 280px; transition: 0.3s; position: relative; overflow: hidden; }
    .step-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--accent), var(--accent-dark)); }
    .step-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(58,123,213,0.15); }
    .step-icon { font-size: 3rem; margin-bottom: 10px; color: var(--accent-dark); }
    .step-icon i { font-size: 3rem; }
    .step-number { font-size: 0.8rem; font-weight: 800; color: var(--accent-dark); letter-spacing: 0.1em; margin-bottom: 12px; opacity: 0.6; }
    .step-card h3 { font-size: 1.3rem; font-weight: 700; margin-bottom: 10px; color: var(--dark); }
    .step-card p { font-size: 0.9rem; color: #6b7280; line-height: 1.6; }
    .step-connector { font-size: 2rem; color: var(--accent-dark); opacity: 0.4; flex-shrink: 0; }

    /* Specialties */
    .specialties-section { padding: 100px 5%; background: #f5f7ff; }
    .specialties-carousel-wrapper { display: flex; align-items: center; gap: 15px; }
    .specialties-carousel { display: flex; gap: 20px; overflow: hidden; scroll-behavior: smooth; padding: 20px 5px; flex: 1; }
    .specialty-card { background: white; border-radius: 24px; padding: 30px 20px; text-align: center; min-width: 165px; flex-shrink: 0; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 4px 15px rgba(0,0,0,0.06); cursor: pointer; transition: 0.3s; }
    .specialty-card:hover { transform: translateY(-8px); box-shadow: 0 15px 35px rgba(58,123,213,0.18); border-color: var(--teal); }
    .specialty-icon { font-size: 2.5rem; margin-bottom: 14px; color: var(--accent-dark); }
    .specialty-icon i { font-size: 2.5rem; }
    .specialty-card span { font-size: 0.9rem; font-weight: 600; color: var(--dark); line-height: 1.3; }
    .carousel-btn { background: white; border: 1px solid #ddd; width: 46px; height: 46px; border-radius: 50%; font-size: 1.5rem; cursor: pointer; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: 0.3s; color: var(--dark); }
    .carousel-btn:hover { background: var(--accent-dark); color: white; border-color: var(--accent-dark); }

    /* FAQ */
    .faq-section { padding: 100px 8%; background: white; }
    .faq-container { max-width: 800px; margin: 0 auto; }
    .faq-item { border-bottom: 1px solid #eee; padding: 24px 0; cursor: pointer; }
    .faq-question { display: flex; justify-content: space-between; align-items: center; gap: 20px; }
    .faq-question span { font-size: 1rem; font-weight: 600; color: var(--dark); }
    .faq-icon { width: 36px; height: 36px; background: rgba(0,180,160,0.12); color: var(--teal); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; transition: 0.3s; }
    .faq-item.open .faq-icon { background: var(--teal); color: white; transform: rotate(45deg); }
    .faq-answer { max-height: 0; overflow: hidden; color: #6b7280; transition: max-height 0.4s ease; }
    .faq-item.open .faq-answer { max-height: 200px; padding-top: 16px; }

    /* Contact */
    .contact-section { padding: 100px 8%; background: linear-gradient(135deg, #f0f4ff, #e8f8ff); }
    .contact-wrapper { display: flex; gap: 60px; flex-wrap: wrap; }
    .contact-info { flex: 1; min-width: 300px; }
    .contact-info h2 { font-size: 2.2rem; font-weight: 800; margin: 16px 0; }
    .contact-info h2 span { color: var(--accent-dark); }
    .contact-details { display: flex; flex-direction: column; gap: 20px; }
    .contact-item { display: flex; gap: 16px; background: white; padding: 16px; border-radius: 16px; }
    .contact-form-card { flex: 1; background: white; padding: 40px; border-radius: 28px; }
    .form-group { margin-bottom: 16px; }
    .form-input { width: 100%; padding: 14px 18px; border: 1.5px solid #e5e7eb; border-radius: 14px; outline: none; }
    .form-input:focus { border-color: var(--accent-dark); }
    .form-textarea { min-height: 120px; }

    /* Footer */
    .footer { background: var(--dark); color: white; padding: 70px 8% 30px; }
    .footer-top { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 50px; margin-bottom: 50px; }
    .footer-brand p { color: rgba(255,255,255,0.6); margin: 16px 0; }
    .social-links { display: flex; gap: 10px; }
    .social-link { width: 36px; height: 36px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: 0.3s; }
    .social-link:hover { background: var(--accent-dark); }
    .footer-col h4 { font-size: 0.85rem; text-transform: uppercase; margin-bottom: 20px; opacity: 0.5; }
    .footer-col a { display: block; color: rgba(255,255,255,0.75); text-decoration: none; margin-bottom: 10px; }
    .footer-col a:hover { color: var(--accent); }
    .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 30px; font-size: 0.8rem; opacity: 0.6; }

    /* Responsive */
    @media (max-width: 900px) {
        .hero { flex-direction: column; text-align: center; padding-top: 120px; }
        .hero-text h1 { font-size: 2.5rem; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .steps-grid { flex-direction: column; }
        .step-connector { transform: rotate(90deg); }
        .footer-top { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 600px) {
        .hero-text h1 { font-size: 2rem; }
        .card { width: 100%; }
        .footer-top { grid-template-columns: 1fr; }
    }
</style>

<script>
    document.addEventListener('mousemove', function(e) {
        const card = document.getElementById('heroCard');
        if (!card) return;
        const rect = card.getBoundingClientRect();
        const cx = rect.left + rect.width / 2;
        const cy = rect.top + rect.height / 2;
        const dx = (e.clientX - cx) / 30;
        const dy = (e.clientY - cy) / 30;
        card.style.transform = `rotateY(${dx}deg) rotateX(${-dy}deg)`;
    });

    const specialties = ['Cardiologie', 'Dermatologie', 'Diététique et Nutrition équilibrée', 'Endocrinologie', 'Gastro-entérologie', 'Gériatrie', 'Neurologie', 'Ophtalmologie', 'Dentisterie', 'Oncologie', 'Pédiatrie', 'Gynécologie', 'Orthopédie', 'Psychiatrie', 'Radiologie'];
    const input = document.getElementById('specialtyInput');
    const autocompleteList = document.getElementById('autocomplete-list');
    if (input) {
        input.addEventListener('input', function() {
            const val = this.value.toLowerCase();
            autocompleteList.innerHTML = '';
            if (!val) { autocompleteList.style.display = 'none'; return; }
            const matches = specialties.filter(s => s.toLowerCase().includes(val));
            if (matches.length === 0) { autocompleteList.style.display = 'none'; return; }
            autocompleteList.style.display = 'block';
            matches.forEach(m => {
                const div = document.createElement('div');
                div.textContent = m;
                div.onclick = () => { input.value = m; autocompleteList.style.display = 'none'; };
                autocompleteList.appendChild(div);
            });
        });
        document.addEventListener('click', e => { if (!e.target.closest('.search-box')) autocompleteList.style.display = 'none'; });
    }

    function searchSpecialty() {
        const val = document.getElementById('specialtyInput').value;
        const results = document.getElementById('results');
        if (!val) return;
        results.innerHTML = '<p style="color:#888;">Recherche en cours...</p>';
        setTimeout(() => results.innerHTML = '<p style="color:#6b7280;">Aucun résultat pour "<strong>' + val + '</strong>".</p>', 800);
    }

    function toggleFAQ(el) {
        const isOpen = el.classList.contains('open');
        document.querySelectorAll('.faq-item').forEach(item => item.classList.remove('open'));
        if (!isOpen) el.classList.add('open');
    }

    function slideSpecialties(dir) {
        const carousel = document.getElementById('specialtiesCarousel');
        if (carousel) carousel.scrollLeft += dir * 200;
    }

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.step-card, .specialty-card, .stat-item, .faq-item, .contact-item').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
</script>

</body>
</html>