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

        /* Carousel */
        .carousel-wrapper {
            position: relative;
            overflow: hidden; /* ← les flèches restent dans le cadre */
        }
        .carousel-btn {
            position: absolute;
            top: 40%; /* ← centré sur l'image (pas sur toute la carte) */
            transform: translateY(-50%);
            z-index: 10;
            background: rgba(0,0,0,0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 22px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }
        .carousel-btn:hover { background: rgba(229,9,20,0.85); }
        .carousel-btn.left { left: 5px; } /* ← sur le film, pas à côté */
        .carousel-btn.right { right: 5px; }

        .film-list {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding: 15px 10px 10px 10px; /* ← plus de padding latéral large */
            scroll-behavior: smooth;
            scrollbar-width: none;
        }
        .film-list::-webkit-scrollbar { display: none; }

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

        /* Hero banner */
        .hero-banner {
            position: relative;
            width: 100%;
            height: 500px;
            overflow: hidden;
        }
        .hero-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            filter: brightness(0.55);
        }
        .hero-content {
            position: absolute;
            bottom: 60px;
            left: 50px;
            z-index: 2;
        }
        .hero-content h1 {
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.8);
            margin-bottom: 10px;
        }
        .hero-content p {
            font-size: 1.1rem;
            color: #ddd;
            max-width: 500px;
            margin-bottom: 20px;
        }
        .hero-badge {
            position: absolute;
            top: 30px;
            left: 50px;
            background: #e50914;
            color: white;
            font-weight: bold;
            font-size: 0.85rem;
            padding: 5px 14px;
            border-radius: 4px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .hero-gradient {
            position: absolute;
            bottom: 0; left: 0;
            width: 100%; height: 60%;
            background: linear-gradient(to top, #0b0b0b, transparent);
            pointer-events: none;
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

    <?php
    $filmVogue = $rep->getFilmEnVogue();
    if (isset($filmVogue)) { ?>
        <div class="hero-banner">
            <?php if ($filmVogue->getBanniere() != null) { ?>
                <img src="<?php echo $filmVogue->getBanniere() ?>" alt="banniere">
            <?php } else { ?>
                <img src="../../img/default.png" alt="banniere">
            <?php } ?>
            <div class="hero-gradient"></div>
            <span class="hero-badge">🔥 En ce moment</span>
            <div class="hero-content">
                <h1><?= htmlspecialchars($filmVogue->getNom()) ?></h1>
                <p><?= htmlspecialchars(substr($filmVogue->getDescription(), 0, 150)) ?>...</p>
                <a href="../Films/ficheFilm.php?id=<?= $filmVogue->getIdFilm() ?>"
                   class="btn btn-danger btn-lg px-4">
                    ▶ Voir le film
                </a>
            </div>
        </div>
    <?php } ?>

    <div class="section">
        <div class="header">
            <h2>Films au cinéma</h2>
            <a href="allFilms.php" class="btn btn-danger">Tous les films actuellement au cinéma</a>
        </div>

        <div class="carousel-wrapper">
            <button class="carousel-btn left" onclick="document.querySelector('.film-list').scrollBy({left: -500, behavior: 'smooth'})">‹</button>

            <div class="film-list">
                <?php if (!empty($tabFilm)) { ?>
                    <?php foreach ($tabFilm as $film) { ?>
                        <div class="film">
                            <?php
                            $affiche = $film->getAffiche();
                            if ($affiche != null && $affiche != "") { ?>
                                <form method="POST" action="../Films/ficheFilm.php?id=<?= $film->getIdFilm() ?>">
                                    <button class="btn btn-dark" type="submit">
                                        <img src="<?= $affiche ?>" alt="<?= $film->getNom() ?>">
                                    </button>
                                </form>
                            <?php } else { ?>
                                <form method="POST" action="../Films/ficheFilm.php?id=<?= $film->getIdFilm() ?>">
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

            <button class="carousel-btn right" onclick="document.querySelector('.film-list').scrollBy({left: 500, behavior: 'smooth'})">›</button>
        </div>
    </div>

    <a href="../crud.php" style="color:#ccc; margin: 0 20px;">Retour aux cruds</a>

</section>
</body>
</html>