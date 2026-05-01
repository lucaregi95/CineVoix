
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
    <style>
        .allo {
            background: #0b0b0b;
            font-family: Arial, sans-serif;
            color: white;
        }

        .section {
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header a {
            color: #ccc;
            text-decoration: none;
            font-size: 14px;
        }

        .film-list {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding-top: 15px;
        }

        .film {
            min-width: 150px;
            position: relative;
        }

        .film img {
            width: 100%;
            border-radius: 10px;
        }

        .film p {
            margin-top: 8px;
            font-size: 14px;
        }

        /* Badge "Nouveau" */
        .badge {
            position: absolute;
            top: 8px;
            right: 8px;
            background: red;
            padding: 3px 6px;
            font-size: 12px;
            border-radius: 4px;
        }
        .film img {
            transition: transform 3s;
        }

        .film:hover img {
            transform: scale(1.05);
        }
        .film img {
            width: 150px;
            height: 220px;
            object-fit: cover; /* coupe proprement l'image */
            border-radius: 10px;
        }</style>
</head>
<body>
<section class="allo">

    <nav class="navbar navbar-expand-sm navbar-dark  border-3" style="background-color: #0d1b4c;">
        <div class="container d-flex justify-content-evenly align-items-center">

            <a class="nav-link text-white" href="accueil.php">Accueil</a>
            <a class="nav-link text-white" href="forum.php">Réservation</a>
            <a class="nav-link text-white" href="aides.php">Mes réservations</a>
            <a class="nav-link text-white" href="profil.php">Profil</a>

        </div>
    </nav>
<div class="section">
    <div class="header">
        <h2>Films au cinéma</h2>
        <a href="#">Tous les films actuellement au cinéma ></a>
    </div>

    <div class="film-list">

        <div class="film">
            <img src="https://image.tmdb.org/t/p/original/dQFwdkCpfc5UOdQigYKQm06VJS4.jpg" alt="Mario" style="">
            <p>Super Mario Galaxy, Le Film</p>
        </div>

        <div class="film">
            <img src="illusion.jpg" alt="">
            <span class="badge">Nouveau</span>
            <p>Juste une illusion</p>
        </div>

        <div class="film">
            <img src="drama.jpg" alt="">
            <p>The Drama</p>
        </div>

        <div class="film">
            <img src="cocorico.jpg" alt="">
            <p>Cocorico 2</p>
        </div>

    </div>
</div>
<?php

if(!empty($tabFilm)){


    ?>

    <a href="../crud.php">Retour aux cruds</a>
<?php }
else{?>
    <h4>Aucun film pour le moment...</h4>
    <a href="../crud.php">Retour aux cruds</a>
<?php }?>
</section>
</body>
</html>
