<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Réclamations - Accueil</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            background: linear-gradient(to right, #16222A, #3A6073);
            color: white;
            font-family: 'Arial', sans-serif;
        }
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            padding: 20px;
        }
        .hero-icon {
            font-size: 70px;
            color: #FFD700;
            margin-bottom: 15px;
            animation: floatIcon 3s infinite alternate;
        }
        @keyframes floatIcon {
            0% { transform: translateY(0px); }
            100% { transform: translateY(-10px); }
        }
        .btn-custom {
            background: linear-gradient(135deg, #ff4b2b, #ff416c);
            color: white;
            font-weight: bold;
            border-radius: 30px;
            padding: 12px 25px;
            transition: all 0.3s ease-in-out;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: none;
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            transform: scale(1.05);
        }
        .btn-outline-custom {
            border: 2px solid white;
            color: white;
            border-radius: 30px;
            padding: 12px 25px;
            transition: all 0.3s ease-in-out;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .btn-outline-custom:hover {
            background: white;
            color: #ff416c;
            transform: scale(1.05);
        }
        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease;
            backdrop-filter: blur(10px);
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .feature-card i {
            font-size: 40px;
            margin-bottom: 10px;
            color: #FFD700;
        }
    </style>
</head>
<body>

<div class="container hero-section">
    <i class="fas fa-clipboard-list hero-icon"></i>
    <h1 class="fw-bold">Bienvenue sur Réclamations Tunisie Télécom</h1>
    <p class="lead">Gérez et suivez vos réclamations en toute simplicité.</p>

    <!-- Features Section -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="feature-card p-3 shadow">
                <i class="fas fa-paper-plane"></i>
                <h5 class="fw-bold">Soumettre une réclamation</h5>
                <p>Facile et rapide, soumettez vos réclamations en ligne.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card p-3 shadow">
                <i class="fas fa-clock"></i>
                <h5 class="fw-bold">Suivi en temps réel</h5>
                <p>Consultez le statut de votre réclamation à tout moment.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card p-3 shadow">
                <i class="fas fa-comments"></i>
                <h5 class="fw-bold">Communication directe</h5>
                <p>Échangez directement avec un expert technique.</p>
            </div>
        </div>
    </div>

    <!-- Authentication Section -->
    <div class="mt-5 d-flex justify-content-center gap-4">
        <a href="{{ route('login') }}" class="btn btn-custom">
            <i class="fas fa-sign-in-alt"></i> Connexion
        </a>
        <a href="{{ route('register') }}" class="btn btn-outline-custom">
            <i class="fas fa-user-plus"></i> Inscription
        </a>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
