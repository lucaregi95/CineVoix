<?php
session_start();

require_once "../../src/bdd/Bdd.php";
require_once "../../src/modele/Reservation.php";
require_once "../../src/repository/ReservationRepository.php";
require_once "../../src/modele/Seances.php";
require_once "../../src/repository/SeancesRepository.php";
require_once "../../src/modele/Film.php";
require_once "../../src/repository/FilmRepository.php";
require_once "../../src/modele/Acteurs.php";
require_once "../../src/repository/ActeursRepository.php";

if (!isset($_SESSION['id']) || ($_SESSION['role'] != 'accueil' && $_SESSION['role'] != 'admin')) {
    header("Location: ../Acteurs/connexionActeur.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: accueilEmploye.php");
    exit();
}

$id = $_GET['id'];
$repRes = new ReservationRepository();
$reservation = $repRes->getReservation($id);

$repSeance = new SeancesRepository();
$seance = $repSeance->getSeances($reservation->getRefSeance());

$repFilm = new FilmRepository();
$film = $repFilm->getFilm($seance->getRefFilm());

$repActeur = new ActeursRepository();
$acteur = $repActeur->getActeur($reservation->getRefActeur());

$succes = null;
$erreur = null;

if (isset($_POST['confirmer'])) {
    $moyen_paiement = null;
    if (isset($_POST['moyen_paiement']) && $_POST['moyen_paiement'] != "") {
        $moyen_paiement = $_POST['moyen_paiement'];
    }

    $reservationMaj = new Reservation(
        $reservation->getIdReservation(),
        'confirmee',
        $reservation->getQtePleinTarif(),
        $reservation->getQteEtudiant(),
        $reservation->getQteSenior(),
        $moyen_paiement,
        $reservation->getRefSeance(),
        $reservation->getRefCode(),
        $reservation->getRefActeur()
    );
    $repRes->modifierReservation($reservationMaj);
    header("Location: accueilEmploye.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Encaissement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f7fc; font-family: Arial, sans-serif; }
        .card { border: 2px solid #0d1b4c; border-radius: 12px; max-width: 500px; margin: 40px auto; }
        .card-header { background: #0d1b4c; color: white; border-radius: 10px 10px 0 0; padding: 15px 20px; }
        .info-label { color: #888; font-size: 0.8rem; text-transform: uppercase; margin-top: 10px; }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Encaissement — Réservation #<?= $reservation->getIdReservation() ?></h5>
    </div>
    <div class="card-body p-4">

        <div class="info-label">Film</div>
        <div><?= $film->getNom() ?> — <?= $seance->getDateSeance() ?></div>

        <div class="info-label">Client</div>
        <div><?= $acteur->getPrenom() ?> <?= $acteur->getNom() ?></div>

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

        <hr>

        <form action="encaissement.php?id=<?= $id ?>" method="post">
            <div class="mb-3">
                <label class="form-label">Moyen de paiement</label>
                <select name="moyen_paiement" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    <option value="carte" <?php if ($reservation->getMoyenPaiement() == "carte") { echo "selected"; } ?>>Carte bancaire</option>
                    <option value="especes" <?php if ($reservation->getMoyenPaiement() == "especes") { echo "selected"; } ?>>Espèces</option>
                    <option value="cheque" <?php if ($reservation->getMoyenPaiement() == "cheque") { echo "selected"; } ?>>Chèque</option>
                </select>
            </div>

            <div class="d-flex gap-2 justify-content-end">
                <a href="accueilEmploye.php" class="btn btn-outline-secondary">Retour</a>
                <button type="submit" name="confirmer" class="btn btn-success">Confirmer l'encaissement</button>
            </div>
        </form>

    </div>
</div>

</body>
</html>