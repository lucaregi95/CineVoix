
<?php
require_once "../../src/traitement/newSeances.php";
require_once "../../src/repository/SeancesRepository.php";
require_once "../../src/modele/Seances.php";
require_once "../../src/repository/FilmRepository.php";
require_once "../../src/modele/Film.php";
require_once "../../src/repository/SalleRepository.php";
require_once "../../src/modele/Salle.php";

$rep = new SeancesRepository();
$tabSeance = $rep -> getAllSeances();
$rep2 = new FilmRepository();
$rep3 = new SalleRepository();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Liste Salle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<form method="post" action="ajoutSeance.php">
    <button>Ajouter</button>
</form>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Date de la seance</th>
        <th>ID Film</th>
        <th>Nom du Film</th>
        <th>ID Salle</th>
        <th>Nom de la salle</th>
        <th>Modifier</th>
        <th>Supprimer</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($tabSeance as $seance){ ?>
    <tr>
        <td><?=$seance->getIdSeance()?></td>
        <td><?=$seance->getDateSeance()?></td>
        <td><?=$seance->getRefFilm()?></td>
        <td><?=$rep2->getFilm($seance->getRefFilm())->getNom()?></td>
        <td><?=$seance->getRefSalle()?></td>
        <td><?=$rep3->getSalle($seance->getRefSalle())->getNom()?></td>
        <td>
            <form method="post" action="modificationSeance.php">
                <button type="submit">Modifier</button>
                <input type="hidden" name="id" value="<?=$seance->getIdSeance()?>">
            </form>
        </td>
        <td>
            <form method="post" action="suppressionSeance.php">
                <button type="submit">Supprimer</button>
                <input type="hidden" name="id" value="<?=$seance->getIdSeance()?>">
            </form>
        </td>
    </tr>
    </tbody>
    <?php } ?>
</table>
<a href="../crud.php">Retour aux cruds</a>
</body>
</html>

