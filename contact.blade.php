<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | MediTime</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .contact-card { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); width: 100%; max-width: 500px; z-index: 2; }
        .contact-info { text-align: left; margin-top: 25px; }
        .info-item { display: flex; align-items: center; gap: 15px; margin-bottom: 20px; }
        .info-item i { color: #00a8e8; font-size: 1.2rem; }
        .contact-card h2 span { color: #00a8e8; }

        /* Style pour la zone de réclamation */
        .reclamation-box {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .reclamation-box label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }
        .reclamation-box textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            resize: none;
            box-sizing: border-box;
        }
        .btn-envoyer {
            width: 100%;
            padding: 12px;
            background: #00a8e8;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 10px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-envoyer:hover { background: #0086ba; }
        .note-inscription {
            font-size: 0.75rem;
            color: #e74c3c;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="background-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <div class="contact-card">
        <h2>Contactez <span>MediTime</span></h2>
        <p style="color: #666; margin-bottom: 30px;">Notre service client est à votre écoute.</p>

        <div class="contact-info">
            <div class="info-item">
                <div><strong>📍 Adresse</strong><br>Campus Universitaire, Le Kef, Tunisie</div>
            </div>
            <div class="info-item">
                <div><strong>📞 Service Client</strong><br>+216 78 000 000</div>
            </div>
            <div class="info-item">
                <div><strong>📧 Email</strong><br>contact@meditime.tn</div>
            </div>
        </div>

        <div class="reclamation-box">
            <label>Votre Réclamation</label>
            <textarea id="txt-reclamation" rows="4" placeholder="Décrivez votre problème ici..."></textarea>
            <small class="note-inscription">* Vous devez être connecté pour envoyer ce formulaire.</small>
            <button onclick="verifierConnexion()" class="btn-envoyer">Envoyer la réclamation</button>
        </div>

        <button onclick="window.history.back()" style="width: 100%; padding: 12px; background: #1e272e; color: white; border: none; border-radius: 10px; cursor: pointer; margin-top: 15px;">Retour</button>
    </div>

    <script>
        function verifierConnexion() {
            // On simule que l'utilisateur n'est pas connecté
            alert("Redirection vers la page de connexion pour valider votre réclamation...");
            window.location.href = "/connexion";
        }
    </script>



</body>
</html>

            
