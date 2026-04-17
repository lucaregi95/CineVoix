
<?php
require_once "../../src/traitement/newFilm.php";
require_once "../../src/repository/FilmRepository.php";
require_once "../../src/modele/Film.php";
$rep = new FilmRepository();
$tabFilm = $rep -> getAllFilmTri();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Liste Films</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('https://trentetroisdegres.fr/wp-content/uploads/2020/03/89487910_872539006520884_553622057548513280_n.jpg');background-size: 100% 100%;background-repeat: no-repeat;
  background-attachment: fixed;">

<nav class="navbar navbar-expand-sm navbar-light bg-light border border-danger border-3">
    <div class="container d-flex justify-content-evenly align-items-center">

        <a class="nav-link" href="specialistes.php">Spécialistes</a>
        <a class="nav-link" href="forum.php">Forum</a>
        <a class="nav-link" href="aides.php">Aides</a>
        <a class="nav-link" href="presentation.php">Handicaps</a>

    </div>
</nav>
<?php

if(!empty($tabFilm)){


    ?>
    <
    <a href="../crud.php">Retour aux cruds</a>
<?php }
else{?>
    <h4>Aucun film pour le moment...</h4>
    <a href="../crud.php">Retour aux cruds</a>
<?php }?>

</body>
</html>
