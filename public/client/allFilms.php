<?php
session_start();
require_once "../../src/traitement/newFilm.php";
require_once "../../src/repository/FilmRepository.php";
require_once "../../src/modele/Film.php";
$rep = new FilmRepository();
$tabFilm = $rep->getAllFilm();
?>

<!DOCTYPE html>
<html lang="fr">
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
            <a class="nav-link text-white" href="reservationClient.php">Mes réservations</a>
            <a class="nav-link text-white" href="profil.php">Profil</a>
            <?php if(isset($_SESSION["id"])): ?>
                <form action="../Acteurs/deconnexionActeur.php">
                    <button type="submit" class="nav-link text-white">Déconnexion</button>
                </form>
            <?php endif; ?>

            <?php if(!isset($_SESSION["id"])): ?>
                <form action="../Acteurs/connexionActeur2.php">
                    <button type="submit" class="nav-link text-white">Connexion</button>
                </form>
            <?php endif; ?>

        </div>
    </nav>

    <div class="section">
        <div class="header">
            <h2>Films au cinéma</h2>

        </div>

        <div style="display:flex; justify-content:center; margin: 20px 0;">
            <div style="display:flex; align-items:center; background:#1a2a6e; border-radius:999px; padding:0 20px; gap:12px; height:48px; border:1px solid rgba(255,255,255,0.15); width:100%; max-width:600px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.5)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input
                    type="text"
                    id="searchFilm"
                    placeholder="Rechercher un film..."
                    style="background:transparent; border:none; outline:none; color:white; font-size:15px; width:100%; caret-color:white;"
                />
            </div>
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
                                    <img src="<?=$affiche?>" alt="<?= $film->getNom() ?>">
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
<script>
    document.getElementById('searchFilm').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        document.querySelectorAll('.film').forEach(function (film) {
            const nom = film.querySelector('p').textContent.toLowerCase();
            film.style.display = nom.includes(query) ? '' : 'none';
        });
    });
</script>
</body>
</html>
