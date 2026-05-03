<?php
session_start();

require_once "../../src/bdd/Bdd.php";
require_once "../../src/modele/Seances.php";
require_once "../../src/repository/SeancesRepository.php";
require_once "../../src/modele/Film.php";
require_once "../../src/repository/FilmRepository.php";
require_once "../../src/modele/Salle.php";
require_once "../../src/repository/SalleRepository.php";
require_once "../../src/modele/Reservation.php";
require_once "../../src/repository/ReservationRepository.php";
require_once "../../src/modele/Acteurs.php";
require_once "../../src/repository/ActeursRepository.php";

if (!isset($_SESSION['id']) || ($_SESSION['role'] != 'accueil' && $_SESSION['role'] != 'admin')) {
    header("Location: ../Acteurs/connexionActeur.php");
    exit();
}

$repSeance = new SeancesRepository();
$repFilm = new FilmRepository();
$repSalle = new SalleRepository();
$repRes = new ReservationRepository();
$repActeur = new ActeursRepository();

$today = date('Y-m-d');
$toutesSeances = $repSeance->getAllSeances();

$seancesDuJour = array();
foreach ($toutesSeances as $s) {
    if ($s->getDateSeance() == $today) {
        $seancesDuJour[] = $s;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Espace Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f7fc; font-family: Arial, sans-serif; }
        .navbar { background-color: #0d1b4c !important; }
        .navbar .nav-link { color: white !important; }
        .seance-card { border: 2px solid #0d1b4c; border-radius: 12px; margin-bottom: 30px; }
        .seance-header { background: #0d1b4c; color: white; padding: 12px 20px; border-radius: 10px 10px 0 0; }
        .badge-statut { padding: 4px 10px; border-radius: 20px; font-size: 0.78rem; font-weight: bold; }
        .statut-attente { background: #856404; color: #fff3cd; }
        .statut-confirmee { background: #155724; color: #d4edda; }
        .statut-annulee { background: #721c24; color: #f8d7da; }
        th { background: #eef2fb; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-sm">
    <div class="container d-flex justify-content-evenly align-items-center">
        <span class="text-white fw-bold">Espace Accueil</span>
        <a class="nav-link" href="../client/accueil.php">Accueil client</a>
        <a class="nav-link text-danger fw-bold" href="../Acteurs/deconnexionActeur.php">Déconnecter</a>
    </div>
</nav>

<div class="container py-4">
    <h2 class="mb-1">Séances du jour</h2>
    <p class="text-muted mb-4"><?= date('d/m/Y') ?></p>

    <?php if (empty($seancesDuJour)) { ?>
        <div class="alert alert-info">Aucune séance aujourd'hui.</div>
    <?php } else { ?>

        <?php foreach ($seancesDuJour as $seance) { ?>
            <?php
            $film = $repFilm->getFilm($seance->getRefFilm());
            $salle = $repSalle->getSalle($seance->getRefSalle());
            $reservations = $repRes->getReservationsBySeance($seance->getIdSeance());
            $placesReservees = $repRes->getNombrePlacesReservees($seance->getIdSeance());
            $placesRestantes = $salle->getCapacite() - $placesReservees;
            ?>

            <div class="seance-card">
                <div class="seance-header d-flex justify-content-between align-items-center">
                    <div>
                        <strong><?= $film->getNom() ?></strong>
                        &nbsp;·&nbsp; <?= $salle->getNom() ?>
                        &nbsp;·&nbsp; <?= $film->getDuree() ?> min
                    </div>
                    <div>
                        <?= $placesReservees ?> / <?= $salle->getCapacite() ?> places réservées
                        &nbsp;|&nbsp; <?= $placesRestantes ?> restante(s)
                    </div>
                </div>

                <div class="p-3">
                    <?php if (empty($reservations)) { ?>
                        <p class="text-muted">Aucune réservation pour cette séance.</p>
                    <?php } else { ?>
                        <table class="table table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Plein tarif</th>
                                <th>Étudiant</th>
                                <th>Senior</th>
                                <th>Total places</th>
                                <th>Paiement</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($reservations as $reservation) { ?>
                                <?php
                                $acteur = $repActeur->getActeur($reservation->getRefActeur());
                                $total = $reservation->getQtePleinTarif() + $reservation->getQteEtudiant() + $reservation->getQteSenior();
                                $statut = $reservation->getStatut();
                                if ($statut == "en attente") {
                                    $classBadge = "statut-attente";
                                } else if ($statut == "confirmee") {
                                    $classBadge = "statut-confirmee";
                                } else {
                                    $classBadge = "statut-annulee";
                                }
                                ?>
                                <tr>
                                    <td><?= $reservation->getIdReservation() ?></td>
                                    <td><?= $acteur->getPrenom() ?> <?= $acteur->getNom() ?></td>
                                    <td><?= $reservation->getQtePleinTarif() ?></td>
                                    <td><?= $reservation->getQteEtudiant() ?></td>
                                    <td><?= $reservation->getQteSenior() ?></td>
                                    <td><?= $total ?></td>
                                    <td><?= $reservation->getMoyenPaiement() ?></td>
                                    <td><span class="badge-statut <?= $classBadge ?>"><?= $statut ?></span></td>
                                    <td>
                                        <?php if ($statut == "en attente") { ?>
                                            <a href="encaissement.php?id=<?= $reservation->getIdReservation() ?>" class="btn btn-sm btn-success">Encaisser</a>
                                            <a href="annulationAccueil.php?id=<?= $reservation->getIdReservation() ?>" class="btn btn-sm btn-danger">Annuler</a>
                                        <?php } else if ($statut == "confirmee") { ?>
                                            <span class="text-success">✓ Encaissée</span>
                                        <?php } else { ?>
                                            <span class="text-danger">✗ Annulée</span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>

        <?php } ?>

    <?php } ?>
</div>

</body>
</html>