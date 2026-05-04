<?php
session_start();

require_once "../../src/bdd/Bdd.php";
require_once "../../src/modele/Reservation.php";
require_once "../../src/repository/ReservationRepository.php";
require_once "../../src/modele/Seances.php";
require_once "../../src/repository/SeancesRepository.php";
require_once "../../src/modele/Film.php";
require_once "../../src/repository/FilmRepository.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../Acteurs/connexionActeur.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: reservationClient.php");
    exit();
}

$id = $_GET['id'];
$repRes = new ReservationRepository();
$reservation = $repRes->getReservation($id);

if ($reservation->getRefActeur() != $_SESSION['id']) {
    header("Location: reservationClient.php");
    exit();
}

$repSeance = new SeancesRepository();
$seance = $repSeance->getSeances($reservation->getRefSeance());
$dateSeance = new DateTime($seance->getDateSeance());
$dateAujourdhui = new DateTime();
$dateAujourdhui->setTime(0, 0, 0);

if ($dateSeance <= $dateAujourdhui) {
    header("Location: reservationClient.php");
    exit();
}

$repFilm = new FilmRepository();
$film = $repFilm->getFilm($seance->getRefFilm());

if (isset($_POST['confirmer'])) {
    $reservationMaj = new Reservation(
        $reservation->getIdReservation(),
        'annulee',
        $reservation->getQtePleinTarif(),
        $reservation->getQteEtudiant(),
        $reservation->getQteSenior(),
        $reservation->getMoyenPaiement(),
        $reservation->getRefSeance(),
        $reservation->getRefCode(),
        $reservation->getRefActeur()
    );
    $repRes->modifierReservation($reservationMaj);
    header("Location: reservationClient.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Annuler une réservation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b0b0b; color: white; font-family: Arial, sans-serif; }
        .navbar { background-color: #0d1b4c !important; }
        .navbar .nav-link { color: white !important; }
        .card { background: #1a1a1a; border: 2px solid #721c24; border-radius: 12px; max-width: 500px; margin: 40px auto; color: white; }
        .card-header { background: #721c24; border-radius: 10px 10px 0 0; padding: 15px 20px; }
        .info-label { color: #aaa; font-size: 0.8rem; text-transform: uppercase; margin-top: 10px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-sm">
    <div class="container d-flex justify-content-evenly align-items-center">
        <a class="nav-link" href="accueil.php">Accueil</a>
        <a class="nav-link" href="reservationClient.php">Mes réservations</a>
        <a class="nav-link" href="profil.php">Profil</a>
    </div>
</nav>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Annuler la réservation #<?= $reservation->getIdReservation() ?></h5>
    </div>
    <div class="card-body p-4">

        <div class="info-label">Film</div>
        <div><?= $film->getNom() ?> — <?= $seance->getDateSeance() ?></div>

        <div class="info-label">Places</div>
        <div>
            <?php if ($reservation->getQtePleinTarif() > 0) { ?>
                Plein tarif : <?= $reservation->getQtePleinTarif() ?>&nbsp;&nbsp;
            <?php } ?>
            <?php if ($reservation->getQteEtudiant() > 0) { ?>
                Étudiant : <?= $reservation->getQteEtudiant() ?>&nbsp;&nbsp;
            <?php } ?>
            <?php if ($reservation->getQteSenior() > 0) { ?>
                Senior : <?= $reservation->getQteSenior() ?>
            <?php } ?>
        </div>

        <hr style="border-color:#333;">
        <p class="text-danger fw-bold">Voulez-vous vraiment annuler cette réservation ?</p>

        <form action="annulationReservationClient.php?id=<?= $id ?>" method="post">
            <div class="d-flex gap-2 justify-content-end">
                <a href="reservationClient.php" class="btn btn-outline-light">Retour</a>
                <button type="submit" name="confirmer" class="btn btn-danger">Confirmer l'annulation</button>
            </div>
        </form>

    </div>
</div>

</body>
</html>