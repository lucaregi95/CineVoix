<?php
require_once "../../src/traitement/newActeurs.php";
require_once "../../src/repository/ActeursRepository.php";
require_once "../../src/modele/Acteurs.php";
$rep = new ActeursRepository();
$tabActeur = $rep -> getAllActeurs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Liste Acteur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Email</th>
        <th>Mot de passe</th>
        <th>Telephone</th>
        <th>Rue</th>
        <th>Code postal</th>
        <th>Ville</th>
        <th>Date de naissance</th>
        <th>Role</th>
        <th>Etat</th>
        <th>Date creation</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($tabActeur as $acteur){ ?>
    <tr>
        <td><?=$acteur->getIdActeur()?></td>
        <td><?=$acteur->getNom()?></td>
        <td><?=$acteur->getPrenom()?></td>
        <td><?=$acteur->getEmail()?></td>
        <td><?=$acteur->getMdp()?></td>
        <td><?=$acteur->getTel()?></td>
        <td><?=$acteur->getRue()?></td>
        <td><?=$acteur->getCP()?></td>
        <td><?=$acteur->getVille()?></td>
        <td><?=$acteur->getDateNaissance()?></td>
        <td><?=$acteur->getRole()?></td>
        <td><?=$acteur->getEtat()?></td>
        <td><?=$acteur->getDateCreation()?></td>
    </tr>
    </tbody>
    <?php } ?>
</table>
</body>
</html>
