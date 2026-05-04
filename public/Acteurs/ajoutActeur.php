<?php

require_once "../../src/modele/Acteurs.php";
require_once "../../src/repository/ActeursRepository.php";
require_once "../../src/traitement/newActeurs.php";

if (isset($acteur)){
    $rep = new ActeursRepository();
    $rep -> ajouterActeur($acteur);
    header("Location:connexionActeur.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi – Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --main-blue: #0d1b4c;
            --main-blue-light: #1d3b8b;
            --main-blue-bg: #eef2fb;
        }

        body {
            background-color: #f5f7fc;
            font-family: 'Candara', sans-serif;
        }

        /* NAVBAR */
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

        /* CARD */
        .card {
            border: 2px solid var(--main-blue);
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(13, 27, 76, 0.12);
        }

        .card-body {
            padding: 2rem;
        }

        /* SECTION TITLES */
        .section-title {
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--main-blue);
            margin-bottom: 1rem;
            letter-spacing: 0.08em;
        }

        /* INPUTS */
        .form-control {
            border-radius: 10px;
            padding: 0.7rem 0.9rem;
        }

        .form-control:focus {
            border-color: var(--main-blue-light);
            box-shadow: 0 0 0 0.2rem rgba(29, 59, 139, 0.15);
        }

        /* BUTTONS */
        .btn-cinema {
            background-color: var(--main-blue);
            border-color: var(--main-blue);
            color: white;
            border-radius: 10px;
            padding: 0.65rem 1.3rem;
        }

        .btn-cinema:hover {
            background-color: var(--main-blue-light);
            border-color: var(--main-blue-light);
            color: white;
        }

        .btn-outline-cinema {
            border: 2px solid var(--main-blue);
            color: var(--main-blue);
            border-radius: 10px;
            padding: 0.65rem 1.3rem;
        }

        .btn-outline-cinema:hover {
            background-color: var(--main-blue);
            color: white;
        }

        /* HEADER */
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
    </style>
</head>

<body>

<nav class="navbar navbar-expand-sm navbar-dark border-3" style="background-color: #0d1b4c;">
    <div class="container d-flex justify-content-evenly align-items-center">
        <a class="nav-link text-white" href="../client/accueil.php">Accueil</a>
        <a class="nav-link text-white" href="../Acteurs/connexionActeur.php">Connexion</a>
    </div>
</nav>

<div class="container py-5" style="max-width: 680px;">

    <div class="card">

        <!-- Header -->
        <div class="profil-header d-flex align-items-center gap-3">
            <div class="icon">🎬</div>
            <div>
                <h5 class="mb-0 fw-bold">Créer un compte</h5>
                <small class="opacity-75">Rejoignez Cinémoi et réservez vos séances</small>
            </div>
        </div>

        <div class="card-body">
            <form action="ajoutActeur.php" method="post">

                <p class="section-title">Informations personnelles</p>
                <div class="row g-3 mb-1">
                    <div class="col-md-6">
                        <label class="form-label">Nom <span class="text-danger">*</span></label>
                        <input type="text" name="nom" id="nom" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Prénom <span class="text-danger">*</span></label>
                        <input type="text" name="prenom" id="prenom" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Téléphone</label>
                        <input type="tel" name="tel" id="tel" class="form-control">
                    </div>
                </div>

                <hr>

                <p class="section-title">Adresse</p>
                <div class="row g-3 mb-1">
                    <div class="col-12">
                        <label class="form-label">Rue</label>
                        <input type="text" name="rue" id="rue" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Code postal</label>
                        <input type="text" name="cp" id="cp" class="form-control"
                               inputmode="numeric" pattern="[0-9]{5}"
                               minlength="5" maxlength="5" placeholder="Ex : 75001">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Ville</label>
                        <input type="text" name="ville" id="ville" class="form-control">
                    </div>
                </div>

                <hr>

                <p class="section-title">Compte</p>
                <div class="row g-3 mb-1">
                    <div class="col-md-6">
                        <label class="form-label">Date de naissance</label>
                        <input type="date" name="date_naissance" id="date_naissance" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mot de passe <span class="text-danger">*</span></label>
                        <input type="password" name="mdp" id="mdp" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-end pt-4">
                    <a href="../Acteurs/connexionActeur.php" class="btn btn-outline-cinema">Déjà un compte ?</a>
                    <button type="submit" name="submit_btn" value="S'inscrire" class="btn btn-cinema">Valider l'inscription</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>