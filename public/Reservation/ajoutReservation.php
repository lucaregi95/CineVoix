<?php
session_start();

require_once "../../src/bdd/Bdd.php";
require_once "../../src/modele/Film.php";
require_once "../../src/repository/FilmRepository.php";
require_once "../../src/modele/Seances.php";
require_once "../../src/repository/SeancesRepository.php";
require_once "../../src/modele/Reservation.php";
require_once "../../src/repository/ReservationRepository.php";
require_once "../../src/modele/CodePromo.php";
require_once "../../src/repository/CodePromoRepository.php";
require_once "../../src/modele/Salle.php";
require_once "../../src/repository/SalleRepository.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../Acteurs/connexionActeur.php");
    exit();
}

if (isset($_GET['id_film'])) {
    $id_film = (int) $_GET['id_film'];
} else if (isset($_POST['id_film'])) {
    $id_film = (int) $_POST['id_film'];
} else {
    header('Location: ../client/accueil.php');
    exit();
}

$repFilm = new FilmRepository();
$film = $repFilm->getFilm($id_film);

$repSeance = new SeancesRepository();
$toutesSeances = $repSeance->getAllSeances();

$seancesDuFilm = array();
foreach ($toutesSeances as $s) {
    if ($s->getRefFilm() == $id_film) {
        $seancesDuFilm[] = $s;
    }
}

$erreur = null;
$succes = null;

if (isset($_POST['ref_seance'])) {

    $qte_plein  = (int) $_POST['qte_plein_tarif'];
    $qte_etu    = (int) $_POST['qte_etudiant'];
    $qte_senior = (int) $_POST['qte_senior'];

    if ($qte_plein + $qte_etu + $qte_senior == 0) {
        $erreur = "Veuillez sélectionner au moins une place.";
    } else {

        $id_acteur = $_SESSION['id'];

        $ref_code = null;
        if (isset($_POST['code_promo']) && $_POST['code_promo'] != "") {
            $repCode = new CodePromoRepository();
            $tousLesCodes = $repCode->getAllCodePromo();
            foreach ($tousLesCodes as $c) {
                if ($c->getCodePromo() == $_POST['code_promo'] && $c->getEtat() == 1) {
                    $ref_code = $c->getIdCodePromo();
                    break;
                }
            }
            if ($ref_code == null) {
                $erreur = "Code promo invalide ou inactif.";
            }
        }

        if ($erreur == null) {
            $repRes = new ReservationRepository();
            $dejaReserve = $repRes->getReservationByActeurAndSeance($id_acteur, $_POST['ref_seance']);
            if ($dejaReserve) {
                $erreur = "Vous avez déjà une réservation pour cette séance.";
            }
        }

        if ($erreur == null){
            $seanceChoisie = $repSeance->getSeances($_POST['ref_seance']);
            $repSalle = new SalleRepository();
            $salle = $repSalle->getSalle($seanceChoisie->getRefSalle());
            $placesDejaReservees = $repRes->getNombrePlacesReservees($_POST['ref_seance']);
            $placesRestantes = $salle->getCapacite() - $placesDejaReservees;
            if ($qte_plein + $qte_etu + $qte_senior > $placesRestantes) {
                $erreur= "Plus assez de places disponibles. Il reste " . $placesRestantes . " places disponibles.";
            }
        }

        if ($erreur == null) {
            $moyen_paiement = null;
            if (isset($_POST['moyen_paiement']) && $_POST['moyen_paiement'] != "") {
                $moyen_paiement = $_POST['moyen_paiement'];
            }

            $reservation = new Reservation(
                    null,
                    'en attente',
                    $qte_plein,
                    $qte_etu,
                    $qte_senior,
                    $moyen_paiement,
                    $_POST['ref_seance'],
                    $ref_code,
                    $id_acteur
            );

            $repRes = new ReservationRepository();
            $repRes->ajouterReservation($reservation);
            $succes = "Réservation effectuée avec succès !";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Réserver</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b0b0b; color: white; font-family: Arial, sans-serif; }
        .container-resa { max-width: 600px; margin: 40px auto; padding: 20px; }
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
        .btn-reserver { background: #e50914; border: none; color: white; width: 100%; padding: 12px; font-size: 1rem; border-radius: 8px; margin-top: 10px; }
        .btn-reserver:hover { background: #c1070f; color: white; }
        .film-header { display: flex; align-items: center; gap: 20px; margin-bottom: 30px; }
        .film-header img { width: 80px; height: 120px; object-fit: cover; border-radius: 8px; }
    </style>
</head>
<body>

<div class="container-resa">

    <div class="film-header">
        <?php
        $affiche = $film->getAffiche();
        if ($affiche != null && $affiche != "") {
            ?>
            <img src="<?= $affiche ?>" alt="<?= $film->getNom() ?>">
        <?php } ?>
        <div>
            <h2><?= $film->getNom() ?></h2>
            <div style="color:#aaa; font-size:0.9rem;"><?= $film->getGenre() ?> · <?= $film->getDuree() ?> min</div>
        </div>
    </div>

    <?php if ($succes != null) { ?>
        <div class="alert alert-success"><?= $succes ?></div>
        <div class="mt-3 text-center">
            <a href="../client/reservationClient.php" class="btn btn-outline-light btn-sm">Voir mes réservations</a>
        </div>
    <?php } else { ?>

        <?php if ($erreur != null) { ?>
            <div class="alert alert-danger"><?= $erreur ?></div>
        <?php } ?>

        <?php if (empty($seancesDuFilm)) { ?>
            <div class="alert alert-warning">Aucune séance disponible pour ce film.</div>
            <a href="../Films/ficheFilm.php?id=<?= $id_film ?>" class="btn btn-outline-light btn-sm">← Retour</a>
        <?php } else { ?>

            <form action="ajoutReservation.php" method="post">
                <input type="hidden" name="id_film" value="<?= $id_film ?>">

                <div class="mb-3">
                    <label class="form-label">Séance</label>
                    <select name="ref_seance" class="form-select" required>
                        <option value="">-- Choisir une séance --</option>
                        <?php foreach ($seancesDuFilm as $seance) { ?>
                            <option value="<?= $seance->getIdSeance() ?>">
                                <?= $seance->getDateSeance() ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Places plein tarif</label>
                    <input type="number" name="qte_plein_tarif" class="form-control" min="0" value="0">
                </div>
                <div class="mb-3">
                    <label class="form-label">Places étudiant</label>
                    <input type="number" name="qte_etudiant" class="form-control" min="0" value="0">
                </div>
                <div class="mb-3">
                    <label class="form-label">Places senior</label>
                    <input type="number" name="qte_senior" class="form-control" min="0" value="0">
                </div>

                <div class="mb-3">
                    <label class="form-label">Moyen de paiement</label>
                    <select name="moyen_paiement" class="form-select" required>
                        <option value="">-- Choisir --</option>
                        <option value="carte">Carte bancaire</option>
                        <option value="especes">Espèces</option>
                        <option value="cheque">Chèque</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Code promo (facultatif)</label>
                    <input type="text" name="code_promo" class="form-control" placeholder="Ex : PROMO10">
                </div>

                <button type="submit" class="btn-reserver">Confirmer la réservation</button>

                <div class="mt-3 text-center">
                    <a href="../Films/ficheFilm.php?id=<?= $id_film ?>" class="btn btn-outline-light btn-sm">← Retour au film</a>
                </div>
            </form>

        <?php } ?>

    <?php } ?>

</div>

</body>
</html>