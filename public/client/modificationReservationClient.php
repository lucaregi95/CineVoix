<?php
session_start();

require_once "../../src/bdd/Bdd.php";
require_once "../../src/modele/Reservation.php";
require_once "../../src/repository/ReservationRepository.php";
require_once "../../src/modele/Seances.php";
require_once "../../src/repository/SeancesRepository.php";
require_once "../../src/modele/Film.php";
require_once "../../src/repository/FilmRepository.php";
require_once "../../src/modele/CodePromo.php";
require_once "../../src/repository/CodePromoRepository.php";

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

$erreur = null;
$succes = null;

if (isset($_POST['confirmer'])) {

    $qte_plein  = $_POST['qte_plein_tarif'];
    $qte_etu    =  $_POST['qte_etudiant'];
    $qte_senior =  $_POST['qte_senior'];

    if ($qte_plein + $qte_etu + $qte_senior == 0) {
        $erreur = "Veuillez sélectionner au moins une place.";
    } else {

        // Code promo
        $ref_code = null;
        if (isset($_POST['code_promo']) && $_POST['code_promo'] != "") {
            $repCode = new CodePromoRepository();
            $tousLesCodes = $repCode->getAllCodePromo();
            foreach ($tousLesCodes as $c) {
                if ($c->getCodePromo() == $_POST['code_promo'] && $c->getEtat() == 1) {
                    $ref_code = $c->getIdCodePromo();
                }
            }
            if ($ref_code == null) {
                $erreur = "Code promo invalide ou inactif.";
            }
        }

        $moyen_paiement = null;
        if (isset($_POST['moyen_paiement']) && $_POST['moyen_paiement'] != "") {
            $moyen_paiement = $_POST['moyen_paiement'];
        }

        if ($erreur == null) {
            $reservationMaj = new Reservation(
                $reservation->getIdReservation(),
                $reservation->getStatut(),
                $qte_plein,
                $qte_etu,
                $qte_senior,
                $moyen_paiement,
                $reservation->getRefSeance(),
                $ref_code,
                $reservation->getRefActeur()
            );
            $repRes->modifierReservation($reservationMaj);
            header("Location: reservationClient.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Modifier une réservation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b0b0b; color: white; font-family: Arial, sans-serif; }
        .navbar { background-color: #0d1b4c !important; }
        .navbar .nav-link { color: white !important; }
        .container-modif { max-width: 500px; margin: 40px auto; padding: 20px; }
        label { color: #aaa; font-size: 0.85rem; text-transform: uppercase; }
        .form-control, .form-select {
            background: #1a1a1a;
            border: 1px solid #444;
            color: white;
        }
        .form-control:focus, .form-select:focus {
            background: #1a1a1a;
            color: white;
            border-color: #e50914;
            box-shadow: none;
        }
        .form-select option { background: #1a1a1a; }
        .film-header { display: flex; align-items: center; gap: 20px; margin-bottom: 25px; }
        .film-header img { width: 60px; height: 90px; object-fit: cover; border-radius: 8px; }
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

<div class="container-modif">

    <div class="film-header">
        <?php
        $affiche = $film->getAffiche();
        if ($affiche != null && $affiche != "") {
            ?>
            <img src="<?= $affiche ?>" alt="<?= $film->getNom() ?>">
        <?php } ?>
        <div>
            <h4><?= $film->getNom() ?></h4>
            <div style="color:#aaa; font-size:0.85rem;"><?= $seance->getDateSeance() ?></div>
        </div>
    </div>

    <?php if ($erreur != null) { ?>
        <div class="alert alert-danger"><?= $erreur ?></div>
    <?php } ?>

    <form action="modificationReservationClient.php?id=<?= $id ?>" method="post">

        <div class="mb-3">
            <label class="form-label">Places plein tarif</label>
            <input type="number" name="qte_plein_tarif" class="form-control" min="0" value="<?= $reservation->getQtePleinTarif() ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Places étudiant</label>
            <input type="number" name="qte_etudiant" class="form-control" min="0" value="<?= $reservation->getQteEtudiant() ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Places senior</label>
            <input type="number" name="qte_senior" class="form-control" min="0" value="<?= $reservation->getQteSenior() ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Moyen de paiement</label>
            <select name="moyen_paiement" class="form-select">
                <option value="carte" <?php if ($reservation->getMoyenPaiement() == "carte") { echo "selected"; } ?>>Carte bancaire</option>
                <option value="especes" <?php if ($reservation->getMoyenPaiement() == "especes") { echo "selected"; } ?>>Espèces</option>
                <option value="cheque" <?php if ($reservation->getMoyenPaiement() == "cheque") { echo "selected"; } ?>>Chèque</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Code promo (facultatif)</label>
            <input type="text" name="code_promo" class="form-control" placeholder="Ex : PROMO10">
        </div>

        <div class="d-flex gap-2 justify-content-end mt-3">
            <a href="reservationClient.php" class="btn btn-outline-light">Retour</a>
            <button type="submit" name="confirmer" class="btn btn-danger">Enregistrer les modifications</button>
        </div>

    </form>

</div>

</body>
</html>