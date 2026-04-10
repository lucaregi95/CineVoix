<?php
require_once "../../src/traitement/newSalle.php";
require_once "../../src/repository/SalleRepository.php";
require_once "../../src/modele/Salle.php";

$rep = new SalleRepository();
$tabSalle = $rep -> getAllSalle();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Liste Salle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Code de la Salle</th>
        <th>Nom de la salle</th>
        <th>Capacite de la salle</th>
        <th>Etat</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($tabSalle as $salle){ ?>
    <tr>
        <td><?=$salle->getIdSalle()?></td>
        <td><?=$salle->getCode  ()?></td>
        <td><?=$salle->getNom()?></td>
        <td><?=$salle->getCapacite()?></td>
        <td><?=$salle->getEtat()?></td>
    </tr>
    </tbody>
    <?php } ?>
</table>
</body>
</html>
