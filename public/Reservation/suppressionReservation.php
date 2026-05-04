<?php
require_once "../../src/bdd/Bdd.php";
require_once "../../src/modele/Reservation.php";
require_once "../../src/repository/ReservationRepository.php";

if (!isset($_POST['id'])) {
    header("Location: tabReservation.php");
    exit();
}

$id = $_POST['id'];
$rep = new ReservationRepository();
$reservation = $rep->getReservation($id);

if (isset($_POST['valide']) && $_POST['valide'] == "oui") {
    $rep->supprimerReservation($reservation);
    header("Location: tabReservation.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Suppression Réservation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<form action="suppressionReservation.php" method="post">
    <h2>Voulez-vous vraiment supprimer la réservation #<?= $reservation->getIdReservation() ?> ?</h2>
    <button type="submit">Supprimer</button>
    <input type="hidden" value="oui" name="valide">
    <input type="hidden" value="<?= $id ?>" name="id">
    <button formaction="tabReservation.php">Retour</button>
</form>
</body>
</html>