<?php
require_once "../../src/traitement/newFilm.php";
require_once "../../src/repository/FilmRepository.php";
require_once "../../src/modele/Film.php";
$rep = new FilmRepository();
$tabFilm = $rep -> getAllFilm();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Liste Films</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>

<?php

if(!empty($tabFilm)){


    ?>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Durée</th>
            <th>Affiche</th>
            <th>Genre</th>
            <th>Age Minimum</th>
            <th>Réalisateur</th>
            <th>Date de sortie</th>
            <th>Bande-annonce</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($tabFilm as $film){ ?>
        <tr>
            <td><?=$film->getIdFilm()?></td>
            <td><?=$film->getNom()?></td>
            <td><?=$film->getDescription()?></td>
            <td><?=$film->getDuree()?></td>
            <td><?=$film->getAffiche()?></td>
            <td><?=$film->getGenre()?></td>
            <td><?=$film->getAgeMin()?></td>
            <td><?=$film->getRealisateur()?></td>
            <td><?=$film->getDateSortie()?></td>
            <td><?=$film->getBandeAnnonce()?></td>
            <td>
                <form method="post" action="modificationFilm.php">
                    <button type="submit">Modifier</button>
                    <input type="hidden" name="id" value="<?=$film->getIdFilm()?>">
                </form>
            </td>
            <td>
                <form method="post" action="suppressionFilm.php">
                    <button type="submit">Supprimer</button>
                    <input type="hidden" name="id" value="<?=$film->getIdFilm()?>">
                </form>
            </td>
        </tr>
        </tbody>
        <?php } ?>
    </table>
    <a href="../crud.php">Retour aux cruds</a>
<?php }
else{?>
    <h4>Aucun film pour le moment...</h4>
    <form method="post" action="ajoutFilm.php">
        <button type="submit">Cliquez ici pour en ajoutez un !</button>
    </form>
    <a href="../crud.php">Retour aux cruds</a>
<?php }?>

</body>
</html>
