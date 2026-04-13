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

<?php

if($tabActeur!=0){


?>
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
        <th>Modifier</th>
        <th>Supprimer</th>
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
        <td><?=$acteur->getTelephone()?></td>
        <td><?=$acteur->getRue()?></td>
        <td><?=$acteur->getCP()?></td>
        <td><?=$acteur->getVille()?></td>
        <td><?=$acteur->getDateNaissance()?></td>
        <td><?=$acteur->getRole()?></td>
        <td><?=$acteur->getEtat()?></td>
        <td><?=$acteur->getDateCreation()?></td>
        <td>
            <form method="post" action="modificationActeur.php">
                <button type="submit">Modifier</button>
                <input type="hidden" name="id" value="<?=$acteur->getIdActeur()?>">
            </form>
        </td>
        <td>
            <form method="post" action="suppressionActeur.php">
                <button type="submit">Supprimer</button>
                <input type="hidden" name="id" value="<?=$acteur->getIdActeur()?>">
            </form>
        </td>
    </tr>
    </tbody>
    <?php } ?>
</table>
    <a href="../crud.php">Retour aux cruds</a>
<?php }
else{?>
    <h4>Aucun inscrit pour le moment...</h4>
    <form method="post" action="ajoutActeur.php">
    <button type="submit">Cliquez ici pour en ajoutez un !</button>
    </form>
    <a href="../crud.php">Retour aux cruds</a>
<?php }?>

</body>
</html>
