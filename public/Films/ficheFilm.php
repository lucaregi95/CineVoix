<?php
session_start();
require_once "../../src/bdd/Bdd.php";
require_once "../../src/modele/Film.php";
require_once "../../src/repository/FilmRepository.php";

if (!isset($_GET['id'])) {
    header('Location: accueil.php');
    exit;
}

$id = $_GET['id'];
$rep = new FilmRepository();
$film = $rep->getFilm($id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - <?= $film->getNom() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b0b0b; color: white; font-family: Arial, sans-serif; }
        .fiche { max-width: 800px; margin: 40px auto; padding: 20px; }
        .fiche img { width: 220px; height: 320px; object-fit: cover; border-radius: 10px; }
        .infos { margin-left: 30px; }
        .infos h1 { font-size: 2rem; margin-bottom: 10px; }
        .label { color: #aaa; font-size: 0.85rem; text-transform: uppercase; margin-top: 12px; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark border-3" style="background-color: #0d1b4c;">
    <div class="container d-flex justify-content-evenly align-items-center">
        <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'accueil' || $_SESSION['role'] == 'admin')) { ?>
            <a class="nav-link text-white" href="../Accueil/accueilEmploye.php">Espace Accueil</a>
        <?php } ?>
        <a class="nav-link text-white" href="../client/accueil.php">Accueil</a>
        <a class="nav-link text-white" href="../client/reservationClient.php">Mes réservations</a>
        <a class="nav-link text-white" href="../client/profil.php">Profil</a>
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

<div class="fiche d-flex">

    <?php if ($film->getAffiche()): ?>
        <img src="<?= htmlspecialchars($film->getAffiche()) ?>" alt="<?= htmlspecialchars($film->getNom()) ?>">
    <?php else: ?>
        <img src="../../img/default.png" alt="<?= $film->getNom() ?>">
    <?php endif; ?>

    <div class="infos">
        <h1><?=($film->getNom()) ?></h1>

        <div class="label">Age Minimum</div>
        <div><?=$film->getAgeMin()?></div>

        <div class="label">Genre</div>
        <div><?=$film->getGenre()?></div>

        <div class="label">Durée</div>
        <div><?= $film->getDuree() ?> min</div>

        <div class="label">Réalisateur</div>
        <div><?=$film->getRealisateur()?></div>

        <div class="label">Date de sortie</div>
        <div><?=$film->getDateSortie()?></div>

        <div class="label">Synopsis</div>
        <p><?= $film->getDescription()?></p>

        <?php if ($film->getBandeAnnonce()): ?>
            <a href="<?= htmlspecialchars($film->getBandeAnnonce()) ?>"
               target="_blank"
               class="btn btn-outline-danger mt-2">
                Bande-annonce
            </a>
        <?php endif; ?>

        <?php if (!isset($_SESSION['role']) || $_SESSION['role'] == 'user'): ?>
            <a href="../Reservation/ajoutReservation.php?id_film=<?= $film->getIdFilm() ?>" class="btn btn-danger mt-2">
                Réserver
            </a>
        <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <a href="../Films/modificationFilm.php?id=<?= $film->getIdFilm() ?>" class="btn btn-warning mt-2">
                Modifier
            </a>
            <a href="../Films/suppressionFilm.php?id=<?= $film->getIdFilm() ?>" class="btn btn-danger mt-2">
                Supprimer
            </a>
        <?php endif; ?>

        <div class="mt-4">
            <a href="../client/accueil.php" class="btn btn-outline-light btn-sm">← Retour</a>
        </div>
    </div>

</div>

</body>
</html>