<?php

require_once "../../src/repository/ReservationRepository.php";
require  "../../src/traitement/newReservation.php";

$ref_seance = $_POST['idSeance'];
$ref_acteur = $_POST['idSeance'];

if(isset($reservation)){
    $rep = new ReservationRepository();
    $rep-> ajouterReservation($reservation);
    header('Location: ajoutReservation '.$_SERVER['PHP_SELF']);
    exit();

}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Ajout reservation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<form action="ajoutReservation.php" method="post">
    <label > Plein tarif :</label>
    <input name="qte_plein_tarif" id="qte_plein_tarif" type="number" min="0" value="0"><br><br>

    <label>Étudiant :</label>
    <input name="qte_etudiant" id="qte_etudiant" type="number" min="0" value="0"><br><br>

    <label>Senior :</label>
    <input name="qte_senior" id="qte_senior" type="number" min="0" value="0"><br><br>

    <label> </label>

    <button type="submit">Valider la réservation</button>
</form>
</body>
</html>
