<?php

require_once "../../src/traitement/newFilm.php";
require_once "../../src/repository/FilmRepository.php";

if (isset($film)) {
    $rep = new FilmRepository();
    $rep->modifierFilm($film);
    header('Location: ' . $_SERVER['PHP_SELF']);
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
                <label>nom film :</label>
                <input type="text" name="nom" required>
            </div>
            <div class="mb-3">
                <label>description :</label>
                <input type="text" name="description" required>
            </div>
            <div class="mb-3">
                <label>duree :</label>
                <input type="time" name="duree" required>
            </div>
            <button type="submit">Valider</button>

</form>
</body>
</html>








