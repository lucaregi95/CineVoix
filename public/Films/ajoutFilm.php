<?php
require_once "../../src/traitement/newFilm.php";
require_once "../../src/repository/FilmRepository.php";

if(isset($film)){
    $rep = new FilmRepository();
    $rep -> ajouterFilm($film);
    header('Location: '.$_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<form action="ajoutFlim.php" method="post">

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Nom du film :</label>
                <input type="text" name="nom" required>
            </div>
            <div class="mb-3">
                <label>Description :</label><br />
                <textarea name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label>Duree :</label>
                <input type="time" name="duree" required>
            </div>
            <div class="mb-3">
                <label>Affiche :</label>
                <input type="file" name="affiche">
            </div>
            <div class="mb-3">
                <label>Genre :</label>
                <input type="text" name="genre">
            </div>
            <div class="mb-3">
                <label>Age minimum :</label>
                <input type="number" name="age_min">
            </div>
            <div class="mb-3">
                <label>Réalisateur :</label>
                <input type="text" name="realisateur">
            </div>
            <div class="mb-3">
                <label>Date de sortie :</label>
                <input type="date" name="date_sortie">
            </div>
            <div class="mb-3">
                <label>Bande-annonce :</label>
                <input type="url" name="bande_annonce">
            </div>
            <button type="submit">Valider</button>
        </div>
    </div>
</form>
</body>
</html>








