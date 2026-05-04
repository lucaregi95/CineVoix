<?php
session_start();
require_once "../../src/traitement/newFilm.php";
require_once "../../src/repository/FilmRepository.php";
require_once "../../src/modele/Film.php";
$rep = new FilmRepository();
$tabFilm = $rep->getAllFilm();
?>

<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .allo {
            background: #0b0b0b;
            font-family: Arial, sans-serif;
            color: white;
            min-height: 100vh;
        }
        .section { padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        .header a { color: #ccc; text-decoration: none; font-size: 14px; }
        .film-list { display: flex; gap: 15px; overflow-x: auto; padding-top: 15px; padding-bottom: 10px; }
        .film { min-width: 150px; position: relative; flex-shrink: 0; }
        .film p { margin-top: 8px; font-size: 14px; }
        .film img {
            width: 150px;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s;
            display: block;
        }
        .film:hover img { transform: scale(1.05); }

        .modal-title {
            margin-bottom: 0;
            color: black;
        }
    </style>
</head>
<body>
<section class="allo">

    <nav class="navbar navbar-expand-sm navbar-dark border-3" style="background-color: #0d1b4c;">
        <div class="container d-flex justify-content-evenly align-items-center">
            <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'accueil' || $_SESSION['role'] == 'admin')) { ?>
                <a class="nav-link text-white" href="../Accueil/accueilEmploye.php">Espace Accueil</a>
            <?php } ?>
            <a class="nav-link text-white" href="accueil.php">Accueil</a>

            <?php if(isset($_SESSION["id"])): ?>
                <a class="nav-link text-white" href="reservationClient.php">Mes réservations</a>
                <a class="nav-link text-white" href="profil.php">Profil</a>
                <form action="../Acteurs/deconnexionActeur.php">
                    <button type="submit" class="nav-link text-white border-0 bg-transparent">Déconnexion</button>
                </form>
            <?php else: ?>
                <button type="button" class="nav-link text-white border-0 bg-transparent"
                        data-bs-toggle="modal" data-bs-target="#modalCompte">
                    Mes réservations
                </button>
                <button type="button" class="nav-link text-white border-0 bg-transparent"
                        data-bs-toggle="modal" data-bs-target="#modalCompte">
                    Connexion
                </button>
            <?php endif; ?>
        </div>
    </nav>


    <div class="modal fade" id="modalCompte" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 p-2">

                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title w-100 text-center fw-semibold">Mon compte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body px-4 pb-4">
                    <a href="../Acteurs/connexionActeur.php" class="btn w-100 fw-semibold py-3 mb-2"
                       style="background:#0d1b4c; color:#cccccc; border-radius:12px;">
                        Me connecter
                    </a>
                    <a href="../Acteurs/ajoutActeur.php" class="btn btn-outline-secondary w-100 py-3"
                       style="border-radius:12px; color:black ">
                        Créer mon compte
                    </a>
                    <hr class="my-3">
                </div>

            </div>
        </div>
    </div>

    <div class="section">
        <div class="header">
            <h2>Films au cinéma</h2>
            <a href="allFilms.php">Tous les films actuellement au cinéma ></a>
        </div>

        <div class="film-list">
            <?php if (!empty($tabFilm)) { ?>
                <?php foreach ($tabFilm as $film) { ?>
                    <div class="film">
                        <?php
                        $affiche = $film->getAffiche();
                        if ($affiche != null && $affiche != "") {
                            ?>
                            <form method="POST" action="../Films/ficheFilm.php?id=<?=$film->getIdFilm()?>">
                                <button class="btn btn-dark" type="submit">
                                    <img src="<?= $affiche ?>" alt="<?= $film->getNom() ?>">
                                </button>
                            </form>

                        <?php } else { ?>
                            <form method="POST" action="../Films/ficheFilm.php?id=<?=$film->getIdFilm()?>">
                                <button class="btn btn-dark" type="submit">
                                    <img src="../../img/default.png" alt="<?= $film->getNom() ?>">
                                </button>
                            </form>
                        <?php } ?>
                        <p><?= $film->getNom() ?></p>
                        <a href="../Films/ficheFilm.php?id=<?= $film->getIdFilm() ?>" class="btn btn-sm btn-outline-light">Info</a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>Aucun film pour le moment...</p>
            <?php } ?>
        </div>
    </div>

    <a href="../crud.php" style="color:#ccc; margin: 0 20px;">Retour aux cruds</a>

</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>