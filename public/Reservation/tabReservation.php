<?php
require_once "../../src/traitement/newReservation.php";
require_once "../../src/repository/ReservationRepository.php";
require_once "../../src/modele/Reservation.php";
require_once "../../src/repository/SeancesRepository.php";
require_once "../../src/modele/Seances.php";
require_once "../../src/repository/FilmRepository.php";
require_once "../../src/modele/Film.php";
require_once "../../src/repository/SalleRepository.php";
require_once "../../src/modele/Salle.php";
require_once "../../src/repository/ActeursRepository.php";
require_once "../../src/modele/Acteurs.php";
require_once "../../src/repository/CodePromoRepository.php";
require_once "../../src/modele/CodePromo.php";

$rep = new ReservationRepository();
$tabRes = $rep -> getAllReservations();
$rep2 = new FilmRepository();
$rep3 = new SalleRepository();
$rep4 = new SeancesRepository();
$rep5 = new ActeursRepository();
$rep6 = new CodePromoRepository();
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
        <th>Statut de la reservation</th>
        <th>Places plein tarif</th>
        <th>Places etudiant</th>
        <th>Places senior</th>
        <th>ID inscrit</th>
        <th>Email inscrit</th>
        <th>ID Code</th>
        <th>Code appliqué</th>
        <th>ID Seance</th>
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
    <?php foreach ($tabRes as $reservation){ ?>
    <tr>
        <td><?=$reservation->getIdReservation()?></td>
        <td><?=$reservation->getStatut()?></td>
        <td><?=$reservation->getQtePleinTarif()?></td>
        <td><?=$reservation->getQteEtudiant()?></td>
        <td><?=$reservation->getQteSenior()?></td>
        <td><?=$reservation->getRefActeur()?></td>
        <td><?=$rep5->getActeur($reservation->getRefActeur())->getEmail()?></td>
        <td><?=$reservation->getRefCode()?></td>

        <?php if($reservation->getRefCode()!=null){ ?>
        <td><?=$rep6->getCodePromo($reservation->getRefCode())->getCodePromo()?></td>
        <?php }else{?>
        <td></td>
        <?php }?>

        <td><?=$reservation->getRefSeance()?></td>
        <td><?=$rep4->getSeances($reservation->getRefSeance())->getDateSeance()?></td>
        <td><?=$rep4->getSeances($reservation->getRefSeance())->getRefFilm()?></td>
        <td><?=$rep2->getFilm($rep4->getSeances($reservation->getRefSeance())->getRefFilm())->getNom()?></td>
        <td><?=$rep4->getSeances($reservation->getRefSeance())->getRefSalle()?></td>
        <td><?=$rep3->getSalle($rep4->getSeances($reservation->getRefSeance())->getRefSalle())->getNom()?></td>
        <td>
            <form method="post" action="modificationReservation.php">
                <button type="submit">Modifier</button>
                <input type="hidden" name="id" value="<?=$reservation->getIdReservation()?>">
            </form>
        </td>
        <td>
            <form method="post" action="suppressionReservation.php">
                <button type="submit">Supprimer</button>
                <input type="hidden" name="id" value="<?=$reservation->getIdReservation()?>">
            </form>
        </td>
    </tr>
    </tbody>
    <?php } ?>
</table>
<a href="../crud.php">Retour aux cruds</a>
</body>
</html>