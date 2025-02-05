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
            background: linear-gradient(to right, #1e3c72, #2a5298);
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
            font-size: 60px;
            margin-bottom: 15px;
            animation: floatIcon 3s infinite alternate;
        }
        @keyframes floatIcon {
            0% { transform: translateY(0px); }
            100% { transform: translateY(-10px); }
        }
        .btn-custom {
            background: white;
            color: #1e3c72;
            font-weight: bold;
            border-radius: 30px;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background: #f1f1f1;
            transform: scale(1.05);
        }
        .card {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 15px;
            padding: 20px;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>

<div class="container hero-section">
    <i class="fas fa-headset hero-icon"></i>
    <h1 class="fw-bold">Bienvenue sur la plateforme de gestion des réclamations</h1>
    <p class="lead">Facilitez la gestion et le suivi de vos plaintes en toute simplicité.</p>

    <div class="card shadow-lg mt-4 p-4 text-dark text-center">
        <h4 class="mb-3">Accédez à votre espace</h4>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('login') }}" class="btn btn-custom btn-lg"><i class="fas fa-sign-in-alt"></i> Connexion</a>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg"><i class="fas fa-user-plus"></i> Inscription</a>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
