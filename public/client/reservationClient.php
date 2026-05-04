<?php
session_start();

require_once "../../src/bdd/Bdd.php";
require_once "../../src/modele/Reservation.php";
require_once "../../src/repository/ReservationRepository.php";
require_once "../../src/modele/Seances.php";
require_once "../../src/repository/SeancesRepository.php";
require_once "../../src/modele/Film.php";
require_once "../../src/repository/FilmRepository.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../Acteurs/connexionActeur.php");
    exit();
}

$id_acteur = $_SESSION['id'];

$rep = new ReservationRepository();
$reservations = $rep->getReservationsByActeur($id_acteur);

$repSeance = new SeancesRepository();
$repFilm = new FilmRepository();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes réservations – Cinémoi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b0b0b; color: white; font-family: Arial, sans-serif; }
        .navbar { background-color: #0d1b4c !important; }
        .navbar .nav-link { color: white !important; }
        .card { background: #1a1a1a; border: 1px solid #333; color: white; border-radius: 12px; }
        .card-title { color: white; }
        .badge-statut {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        .statut-attente { background: #856404; color: #fff3cd; }
        .statut-confirmee { background: #155724; color: #d4edda; }
        .statut-annulee { background: #721c24; color: #f8d7da; }
        .info-label { color: #aaa; font-size: 0.8rem; text-transform: uppercase; margin-top: 10px; }
        .film-thumb { width: 60px; height: 90px; object-fit: cover; border-radius: 6px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-sm navbar-dark border-3" style="background-color: #0d1b4c;">
    <div class="container d-flex justify-content-evenly align-items-center">
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'accueil'): ?>
            <a class="nav-link text-white" href="../Accueil/accueilEmploye.php">Espace Accueil</a>
        <?php endif; ?>
        <a class="nav-link text-white" href="accueil.php">Accueil</a>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <a class="nav-link text-white" href="../crud.php">Accès aux cruds</a>
        <?php elseif (!isset($_SESSION['role']) || $_SESSION['role'] == 'user'): ?>
            <a class="nav-link text-white" href="reservationClient.php">Mes réservations</a>
        <?php endif; ?>
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
<div class="container py-5">
    <h2 class="mb-4">Mes réservations</h2>

    <?php if (empty($reservations)) { ?>
        <div class="alert alert-info">
            Vous n'avez aucune réservation.
            <a href="accueil.php" class="btn btn-sm btn-outline-primary ms-3">Voir les films</a>
        </div>
    <?php } else { ?>

        <div class="row g-4">
            <?php foreach ($reservations as $reservation) { ?>
                <?php
                $seance = $repSeance->getSeances($reservation->getRefSeance());
                $film = $repFilm->getFilm($seance->getRefFilm());
                $affiche = $film->getAffiche();
                $dateSeance = new DateTime($seance ->getDateSeance());
                $dateAujourdhui = new DateTime();
                $dateAujourdhui->setTime(0, 0, 0);
                $peutModifier = $dateSeance > $dateAujourdhui;

                $statut = $reservation->getStatut();
                if ($statut == "en attente") {
                    $classStatut = "statut-attente";
                } else if ($statut == "confirmee") {
                    $classStatut = "statut-confirmee";
                } else {
                    $classStatut = "statut-annulee";
                }
                ?>
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <?php if ($peutModifier) { ?>
                            <hr style="border-color:#333; ">
                            <div class="d-flex gap-2 mt-2">
                                <a href="../Reservation/modificationReservation.php?id=<$reservation->getIdReservation() ?>" class="btn btn-sm btn-outline-light">Modifier</a>
                                <a href="../Reservation/suppressionReservation.php?id=<?= $reservation->getIdReservation() ?>" class="btn btn-sm btn-outline-danger">Annuler</a>
                            </div>
                        <?php } ?>
                        <div class="card-body">

                            <div class="d-flex gap-3 align-items-start">
                                <?php if ($affiche != null && $affiche != "") { ?>
                                    <img src="<?= $affiche ?>" class="film-thumb" alt="<?= $film->getNom() ?>">
                                <?php } ?>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1"><?= $film->getNom() ?></h5>
                                    <div style="color:#aaa; font-size:0.85rem;">
                                        <?= $seance->getDateSeance() ?>
                                    </div>
                                    <span class="badge-statut <?= $classStatut ?> mt-2 d-inline-block">
                                        <?= $statut ?>
                                    </span>
                                </div>
                            </div>

                            <hr style="border-color:#333;">

                            <div class="info-label">Places</div>
                            <div><cl></cl>
                                <?php if ($reservation->getQtePleinTarif() > 0) { ?>
                                    Plein tarif : <?= $reservation->getQtePleinTarif() ?>&nbsp;&nbsp;
                                <?php } ?>
                                <?php if ($reservation->getQteEtudiant() > 0) { ?>
                                    Étudiant : <?= $reservation->getQteEtudiant() ?>&nbsp;&nbsp;
                                <?php } ?>
                                <?php if ($reservation->getQteSenior() > 0) { ?>
                                    Senior : <?= $reservation->getQteSenior() ?>
                                <?php } ?>
                            </div>

                            <div class="info-label">Paiement</div>
                            <div><?= $reservation->getMoyenPaiement() ?></div>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    <?php } ?>
</div>

</body>
</html>