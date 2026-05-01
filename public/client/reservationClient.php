<?php
session_start();

require_once "../../src/bdd/Bdd.php";
require_once "../../src/modele/Reservation.php";
require_once "../../src/repository/ReservationRepository.php";

if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
}

$id_acteur = $_SESSION['id'];

$rep = new ReservationRepository();
$reservations = $rep->getReservationsByActeur($id_acteur);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes réservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-sm">
    <div class="container d-flex justify-content-evenly align-items-center">
        <a class="nav-link" href="accueil.php">Accueil</a>
        <a class="nav-link" href="forum.php">Réservation</a>
        <a class="nav-link" href="reservationClient.php">Mes réservations</a>
        <a class="nav-link" href="profil.php">Profil</a>
    </div>
</nav>

<div class="container py-5">
    <h2 class="mb-4">Mes réservations</h2>

    <?php if (empty($reservations)): ?>
        <div class="alert alert-info">
            Vous n'avez aucune réservation.
        </div>
    <?php else: ?>

        <div class="row g-4">
            <?php foreach ($reservations as $reservation): ?>
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">

                            <h5 class="card-title">
                                Réservation #<?= $reservation->getIdReservation() ?>
                            </h5>

                            <p class="mb-1">
                                <strong>Statut :</strong>
                                <?= htmlspecialchars($reservation->getStatut()) ?>
                            </p>

                            <p class="mb-1">
                                <strong>Plein tarif :</strong>
                                <?= $reservation->getQtePleinTarif() ?>
                            </p>

                            <p class="mb-1">
                                <strong>Étudiant :</strong>
                                <?= $reservation->getQteEtudiant() ?>
                            </p>

                            <p class="mb-1">
                                <strong>Senior :</strong>
                                <?= $reservation->getQteSenior() ?>
                            </p>

                            <p class="mb-1">
                                <strong>Paiement :</strong>
                                <?= htmlspecialchars($reservation->getMoyenPaiement()) ?>
                            </p>

                            <p class="mb-0">
                                <strong>Séance :</strong>
                                <?= $reservation->getRefSeance() ?>
                            </p>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>
</div>

</body>
</html>
