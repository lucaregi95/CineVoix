<?php

require_once "../../src/traitement/newFilm.php";
require_once "../../src/repository/FilmRepository.php";


if (isset($_POST['id'])) {
    $id_film = $_POST['id'];
} elseif (isset($_GET['id'])) {
    $id_film = $_GET['id'];
}


$cpr = new FilmRepository();
if(isset($film)){
    $cpr->modifierFilm($film);



}

$o=$cpr->getFilm($id_film);



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Modifcation Film</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<form action="modificationFilm.php" method="post">

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>nom film :</label>
                <input type="text" name="nom" value="<?php echo $o->getNom()?>" required>
            </div>
            <div class="mb-3">
                <label>description :</label>
                <input type="text" name="description" value="<?php echo $o->getDescription()?>" required>
            </div>
            <?php
            $duree=$o->getDuree();
            $heures = floor($duree / 60);
            $minutes = $duree % 60;

            $heureFormattee = sprintf('%02d:%02d', $heures, $minutes);
            ?>
            <div class="mb-3">
                <label>duree :</label>
                <input type="time" name="duree" value="<?php echo $heureFormattee ?>"  required>
            </div>
            <div class="mb-3">
                <label>Affiche :</label>
                <input type="url" name="affiche" value="<?php echo $o->getAffiche()?>">
            </div>
            <div class="mb-3">
                <label>Genre :</label>
                <input type="text" name="genre" value="<?php echo $o->getGenre()?>">
            </div>
            <div class="mb-3">
                <label>Age minimum :</label>
                <input type="number" name="age_min" value="<?php echo $o->getAgeMin()?>">
            </div>
            <div class="mb-3">
                <label>Réalisateur :</label>
                <input type="text" name="realisateur" value="<?php echo $o->getRealisateur()?>">
            </div>
            <div class="mb-3">
                <label>Date de sortie :</label>
                <input type="date" name="date_sortie" value="<?php echo $o->getDateSortie()?>">
            </div>
            <div class="mb-3">
                <label>Bande-annonce :</label>
                <input type="url" name="bande_annonce" value="<?php echo $o->getBandeAnnonce()?>">
            </div>
            <input type="hidden" name="id_film" value="<?php echo $id_film?>">
            <button type="submit">Valider</button>
            <button formaction="tabFilm.php">Retour</button>
        </div>
    </div>
</form>
</body>
</html>








