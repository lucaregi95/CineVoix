<?php
require_once "../../src/bdd/Bdd.php";
require_once "../../src/modele/Reservation.php";
require_once "../../src/repository/ReservationRepository.php";
require_once "../../src/modele/Seances.php";
require_once "../../src/repository/SeancesRepository.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: tabReservation.php");
    exit();
}

$rep = new ReservationRepository();

if (isset($_POST['statut']) && isset($_POST['qte_plein_tarif'])) {
    $moyen_paiement = null;
    if (isset($_POST['moyen_paiement']) && $_POST['moyen_paiement'] != "") {
        $moyen_paiement = $_POST['moyen_paiement'];
    }

    $reservation = new Reservation(
        $id,
        $_POST['statut'],
        $_POST['qte_plein_tarif'],
        $_POST['qte_etudiant'],
        $_POST['qte_senior'],
        $moyen_paiement,
        $_POST['ref_seance'],
        null,
        $_POST['ref_acteur']
    );
    $rep->modifierReservation($reservation);
    header("Location: tabReservation.php");
    exit();
}

$o = $rep->getReservation($id);


$repSeance = new SeancesRepository();
$toutesSeances = $repSeance->getAllSeances();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Modification Réservation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<form action="modificationReservation.php" method="post">

    <div class="mb-3">
        <label>Statut :</label>
        <select name="statut">
            <option value="en attente" <?php if ($o->getStatut() == "en attente") { echo "selected"; } ?>>En attente</option>
            <option value="confirmee" <?php if ($o->getStatut() == "confirmee") { echo "selected"; } ?>>Confirmée</option>
            <option value="annulee" <?php if ($o->getStatut() == "annulee") { echo "selected"; } ?>>Annulée</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Places plein tarif :</label>
        <input type="number" name="qte_plein_tarif" min="0" value="<?= $o->getQtePleinTarif() ?>">
    </div>
    <div class="mb-3">
        <label>Places étudiant :</label>
        <input type="number" name="qte_etudiant" min="0" value="<?= $o->getQteEtudiant() ?>">
    </div>
    <div class="mb-3">
        <label>Places senior :</label>
        <input type="number" name="qte_senior" min="0" value="<?= $o->getQteSenior() ?>">
    </div>

    <div class="mb-3">
        <label>Moyen de paiement :</label>
        <select name="moyen_paiement">
            <option value="carte" <?php if ($o->getMoyenPaiement() == "carte") { echo "selected"; } ?>>Carte bancaire</option>
            <option value="especes" <?php if ($o->getMoyenPaiement() == "especes") { echo "selected"; } ?>>Espèces</option>
            <option value="cheque" <?php if ($o->getMoyenPaiement() == "cheque") { echo "selected"; } ?>>Chèque</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Séance :</label>
        <select name="ref_seance">
            <?php foreach ($toutesSeances as $seance) { ?>
                <option value="<?= $seance->getIdSeance() ?>" <?php if ($seance->getIdSeance() == $o->getRefSeance()) { echo "selected"; } ?>>
                    <?= $seance->getDateSeance() ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <input type="hidden" name="ref_acteur" value="<?= $o->getRefActeur() ?>">
    <input type="hidden" name="id" value="<?= $id ?>">
    <button type="submit">Valider</button>
    <button formaction="tabReservation.php">Retour</button>

</form>
</body>
</html>