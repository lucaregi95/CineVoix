<?php

session_start();

require_once "../../src/bdd/Bdd.php";
require_once "../../src/modele/Acteurs.php";
require_once "../../src/repository/ActeursRepository.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../Acteurs/connexionActeur.php");
    exit();
}

$rep = new ActeursRepository();
$id_acteur = $_SESSION['id'];

$erreur = null;

if (isset($_POST['nom'])) {
    $acteurActuel = $rep->getActeur($id_acteur);

    if (!empty($_POST['mdp']) || !empty($_POST['mdp_confirm'])) {

        if ($_POST['mdp'] !== $_POST['mdp_confirm']) {
            $erreur = "Les mots de passe ne correspondent pas.";
        }

        elseif (strlen($_POST['mdp']) < 12) {
            $erreur = "Le mot de passe doit contenir au moins 12 caractères.";
        }

        else {
            $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
        }

    } else {
        $mdp = $acteurActuel->getMdp();
    }

    if (!$erreur) {
        $acteur = new Acteurs(
                $id_acteur,
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $mdp,
                $_POST['date_naissance'],
                $_POST['tel'],
                $_POST['rue'],
                $_POST['ville'],
                $_POST['cp'],
                $acteurActuel->getRole(),
                $acteurActuel->getEtat()
        );

        $rep->modifierActeur($acteur);

        header("Location: profil.php?id=" . $id_acteur . "&success=1");
        exit();
    }
}

$modif = $rep->getActeur($id_acteur);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon profil – Cinémoi</title>
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

        /* HEADER PROFIL */
        .profil-header {
            background: linear-gradient(135deg, #0d1b4c, #1d3b8b);
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 1.5rem;
        }

        .profil-header .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
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
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'accueil'): ?>
            <a class="nav-link text-white" href="../Accueil/accueilEmploye.php">Espace Accueil</a>
        <?php endif; ?>
        <a class="nav-link text-white" href="accueil.php">Accueil</a>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <a class="nav-link text-white" href="../crud.php">Accès aux cruds</a>
        <?php elseif (!isset($_SESSION['role']) || $_SESSION['role'] == 'user'): ?>
            <a class="nav-link text-white" href="reservationClient.php">Mes réservations</a>
        <?php endif; ?>
        <a class="nav-link text-white" href="profil.php">Profil</a>
        <?php if(isset($_SESSION["id"])): ?>
            <form action="../Acteurs/deconnexionActeur.php">
                <button type="submit" class="nav-link text-white">Déconnexion</button>
            </form>
        <?php endif; ?>

        <?php if(!isset($_SESSION["id"])): ?>
            <form action="../Acteurs/connexionActeur2.php">
                <button type="submit" class="nav-link text-white">Connexion</button>
            </form>
        <?php endif; ?>

    </div>
</nav>

<div class="container py-5" style="max-width: 680px;">

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <strong>✓</strong> Modifications enregistrées avec succès.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if ($erreur): ?>
        <div class="alert alert-danger shadow-sm">
            <strong>✕</strong> <?= htmlspecialchars($erreur) ?>
        </div>
    <?php endif; ?>

    <div class="card">

        <!-- Header avec avatar -->
        <div class="profil-header d-flex align-items-center gap-3">
            <div class="avatar">
                <?= strtoupper(substr($modif->getPrenom(), 0, 1) . substr($modif->getNom(), 0, 1)) ?>
            </div>
            <div>
                <p class="profil-name"><?= htmlspecialchars($modif->getPrenom() . ' ' . $modif->getNom()) ?></p>
                <p class="profil-role"><?= htmlspecialchars(ucfirst($modif->getRole())) ?></p>
            </div>
        </div>

        <div class="card-body">
            <form action="profil.php" method="POST">

                <p class="section-title">Informations personnelles</p>
                <div class="row g-3 mb-1">
                    <div class="col-md-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($modif->getNom()) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($modif->getPrenom()) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($modif->getEmail()) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Téléphone</label>

                        <input type="tel" name="tel" class="form-control" value="<?php if($modif->getTelephone()!=null){ echo htmlspecialchars($modif->getTelephone()) ;} ?>">
                    </div>
                </div>

                <hr>

                <p class="section-title">Adresse</p>
                <div class="row g-3 mb-1">
                    <div class="col-12">
                        <label class="form-label">Rue</label>
                        <input type="text" name="rue" class="form-control" value="<?php if($modif->getRue()!=null){ echo htmlspecialchars($modif->getRue());} ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Code postal</label>
                        <input type="text" name="cp" class="form-control" value="<?php if($modif->getCp()!=null){echo htmlspecialchars($modif->getCp());}?>" maxlength="6">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Ville</label>
                        <input type="text" name="ville" class="form-control" value="<?php if($modif->getVille()!=null){ echo htmlspecialchars($modif->getVille());} ?>">
                    </div>
                </div>

                <hr>

                <p class="section-title">Compte</p>
                <div class="row g-3 mb-1">
                    <div class="col-md-6">
                        <label class="form-label">Date de naissance</label>
                        <input type="date" name="date_naissance" class="form-control" value="<?php if($modif->getDateNaissance()!=null){ echo htmlspecialchars($modif->getDateNaissance());} ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Rôle</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars(ucfirst($modif->getRole())) ?>" disabled>
                        <div class="form-text">Non modifiable</div>
                    </div>
                </div>

                <hr>

                <p class="section-title">
                    Mot de passe
                    <span class="text-muted fw-normal text-lowercase" style="font-size:0.75rem; letter-spacing:0;">— laisser vide pour ne pas modifier</span>
                </p>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="mdp" class="form-control" placeholder="••••••••">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirmer</label>
                        <input type="password" name="mdp_confirm" class="form-control" placeholder="••••••••">
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-end pt-2">
                    <a href="accueil.php" class="btn btn-outline-cinema">Retour</a>
                    <a href="../Acteurs/deconnexionActeur.php" class="btn btn-cinema">Déconnexion</a>
                    <button type="submit" class="btn btn-cinema">Enregistrer</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>