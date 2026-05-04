<?php

require_once('../../src/bdd/Bdd.php');

$nom=null;
$prenom=null;
$email=null;
if(isset($_POST['email'])){
    $email=$_POST['email'];
}
$erreur=null;
$inscription=null;
if(isset($_GET['erreur'])){
    if ($_GET['erreur']=='unknown'){
        $erreur="Identifiants inexistants ou incorrects.";
    }if ($_GET['erreur']=='bannir'){
        $erreur="Votre compte a été banni.";
    }
}

if(isset($_GET['page'])){
    $page=$_GET['page'];
}
$inscription="Pas de compte ? Inscrivez-vous";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi – Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --main-blue: #0d1b4c;
            --main-blue-light: #1d3b8b;
        }

        body {
            background-color: #f5f7fc;
            font-family: 'Candara', sans-serif;
        }

        .navbar {
            background-color: var(--main-blue) !important;
            border-bottom: 3px solid var(--main-blue-light);
        }

        .navbar .nav-link {
            color: white !important;
            font-weight: 500;
            transition: 0.2s;
        }

        .navbar .nav-link:hover {
            color: #d6e4ff !important;
        }

        .card {
            border: 2px solid var(--main-blue);
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(13, 27, 76, 0.12);
        }

        .card-body {
            padding: 2rem;
        }

        .section-title {
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--main-blue);
            margin-bottom: 1rem;
            letter-spacing: 0.08em;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.7rem 0.9rem;
        }

        .form-control:focus {
            border-color: var(--main-blue-light);
            box-shadow: 0 0 0 0.2rem rgba(29, 59, 139, 0.15);
        }

        .btn-cinema {
            background-color: var(--main-blue);
            border-color: var(--main-blue);
            color: white;
            border-radius: 10px;
            padding: 0.65rem 1.3rem;
            width: 100%;
        }

        .btn-cinema:hover {
            background-color: var(--main-blue-light);
            border-color: var(--main-blue-light);
            color: white;
        }

        .profil-header {
            background: linear-gradient(135deg, #0d1b4c, #1d3b8b);
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 1.5rem;
        }

        .profil-header .icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            border: 2px solid rgba(255,255,255,0.35);
        }

        hr {
            border-color: #dbe3f7;
        }

        .link-cinema {
            color: var(--main-blue);
            font-weight: 500;
            text-decoration: none;
        }

        .link-cinema:hover {
            color: var(--main-blue-light);
            text-decoration: underline;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-sm navbar-dark border-3" style="background-color: #0d1b4c;">
    <div class="container d-flex justify-content-evenly align-items-center">
        <a class="nav-link text-white" href="../client/accueil.php">Accueil</a>
        <a class="nav-link text-white" href="ajoutActeur.php">Inscription</a>
    </div>
</nav>

<div class="container py-5" style="max-width: 480px;">

    <div class="card">

        <div class="profil-header d-flex align-items-center gap-3">
            <div class="icon">🔐</div>
            <div>
                <h5 class="mb-0 fw-bold">Connexion</h5>
                <small class="opacity-75">Accédez à votre espace Cinémoi</small>
            </div>
        </div>

        <div class="card-body">

            <?php if ($erreur): ?>
                <div class="alert alert-danger shadow-sm mb-3">
                    <strong>✕</strong> <?= htmlspecialchars($erreur) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="connexionActeur2.php">

                <p class="section-title">Identifiants</p>

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" id="email" name="email"
                           class="form-control"
                           value="<?= htmlspecialchars($email ?? '') ?>"
                           autocomplete="off" required>
                </div>

                <div class="mb-4">
                    <label for="mdp" class="form-label">Mot de passe</label>
                    <input type="password" id="mdp" name="mdp"
                           class="form-control"
                           placeholder="••••••••"
                           autocomplete="off" required>
                </div>

                <?php if (isset($page)): ?>
                    <input type="hidden" value="<?= htmlspecialchars($page) ?>" name="page">
                <?php endif; ?>

                <button type="submit" class="btn btn-cinema mb-3">Se connecter</button>

            </form>

            <hr>

            <div class="text-center pt-1">
                <a href="ajoutActeur.php" class="link-cinema"><?= $inscription ?></a>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>