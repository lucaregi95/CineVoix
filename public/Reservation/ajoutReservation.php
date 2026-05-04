<?php
session_start();

require_once "../../src/bdd/Bdd.php";
require_once "../../src/modele/Film.php";
require_once "../../src/repository/FilmRepository.php";
require_once "../../src/modele/Seances.php";
require_once "../../src/repository/SeancesRepository.php";
require_once "../../src/modele/Reservation.php";
require_once "../../src/repository/ReservationRepository.php";
require_once "../../src/modele/CodePromo.php";
require_once "../../src/repository/CodePromoRepository.php";
require_once "../../src/modele/Salle.php";
require_once "../../src/repository/SalleRepository.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../Acteurs/connexionActeur.php");
    exit();
}

if (isset($_GET['id_film'])) {
    $id_film = (int)$_GET['id_film'];
} else if (isset($_POST['id_film'])) {
    $id_film = (int)$_POST['id_film'];
} else {
    header('Location: ../client/accueil.php');
    exit();
}

$repFilm = new FilmRepository();
$film = $repFilm->getFilm($id_film);

$repSeance = new SeancesRepository();
$toutesSeances = $repSeance->getAllSeances();
$dateActuelle = date("Y-m-d");
$seancesDuFilm = array();
foreach ($toutesSeances as $s) {
    if ($s->getRefFilm() == $id_film && $s->getDateSeance() > $dateActuelle) {
        $seancesDuFilm[] = $s;
    }
}

$erreur = null;
$succes = null;

if (isset($_POST['ref_seance'])) {
    $qte_plein = (int)$_POST['qte_plein_tarif'];
    $qte_etu   = (int)$_POST['qte_etudiant'];
    $qte_senior = (int)$_POST['qte_senior'];

    if ($qte_plein + $qte_etu + $qte_senior == 0) {
        $erreur = "Veuillez sélectionner au moins une place.";
    } else {
        $id_acteur = $_SESSION['id'];
        $ref_code = null;

        if (isset($_POST['code_promo']) && $_POST['code_promo'] != "") {
            $repCode = new CodePromoRepository();
            $tousLesCodes = $repCode->getAllCodePromo();
            foreach ($tousLesCodes as $c) {
                if ($c->getCodePromo() == $_POST['code_promo'] && $c->getEtat() == 1) {
                    $ref_code = $c->getIdCodePromo();
                    break;
                }
            }
            if ($ref_code == null) {
                $erreur = "Code promo invalide ou inactif.";
            }else{
                $reservation = new ReservationRepository();
                $res = $reservation->getAllReservations();
                foreach ($res as $r) {
                    if ($r->getRefCode() == $ref_code && $r->getRefActeur()==$id_acteur) {
                        $erreur="Vous avez déjà utilisé ce code";
                    }
                }
            }

        }



        if ($erreur == null) {
            $repRes = new ReservationRepository();
            $dejaReserve = $repRes->getReservationByActeurEtSeance($id_acteur, $_POST['ref_seance']);
            if ($dejaReserve) {
                $erreur = "Vous avez déjà une réservation pour cette séance.";
            }
        }

        if ($erreur == null) {
            $seanceChoisie = $repSeance->getSeances($_POST['ref_seance']);
            $repSalle = new SalleRepository();
            $salle = $repSalle->getSalle($seanceChoisie->getRefSalle());
            $placesDejaReservees = $repRes->getNombrePlacesReservees($_POST['ref_seance']);
            $placesRestantes = $salle->getCapacite() - $placesDejaReservees;
            if ($qte_plein + $qte_etu + $qte_senior > $placesRestantes) {
                $erreur = "Plus assez de places disponibles. Il reste " . $placesRestantes . " places disponibles.";
            }
        }

        if ($erreur == null) {
            $moyen_paiement = null;
            if (isset($_POST['moyen_paiement']) && $_POST['moyen_paiement'] != "") {
                $moyen_paiement = $_POST['moyen_paiement'];
            }

            $reservation = new Reservation(
                    null,
                    'en attente',
                    $qte_plein,
                    $qte_etu,
                    $qte_senior,
                    $moyen_paiement,
                    $_POST['ref_seance'],
                    $ref_code,
                    $id_acteur
            );

            $repRes = new ReservationRepository();
            $repRes->ajouterReservation($reservation);
            $succes = "Réservation effectuée avec succès !";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Réserver</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b0b0b; color: white; font-family: Arial, sans-serif; }
        .container-resa { max-width: 600px; margin: 40px auto; padding: 20px; }
        label { color: #aaa; font-size: 0.85rem; text-transform: uppercase; }
        .form-control, .form-select {
            background: #1a1a1a;
            border: 1px solid #444;
            color: white;
        }
        .form-control:focus, .form-select:focus {
            background: #1a1a1a;
            color: white;
            border-color: #e50914;
            box-shadow: none;
        }
        .form-select option { background: #1a1a1a; }
        .btn-reserver {
            background: #e50914; border: none; color: white;
            width: 100%; padding: 12px; font-size: 1rem;
            border-radius: 8px; margin-top: 10px; cursor: pointer;
        }
        .btn-reserver:hover { background: #c1070f; color: white; }
        .film-header { display: flex; align-items: center; gap: 20px; margin-bottom: 30px; }
        .film-header img { width: 80px; height: 120px; object-fit: cover; border-radius: 8px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-sm navbar-dark border-3" style="background-color: #0d1b4c;">
    <div class="container d-flex justify-content-evenly align-items-center">
        <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'accueil' || $_SESSION['role'] == 'admin')) { ?>
            <a class="nav-link text-white" href="../Accueil/accueilEmploye.php">Espace Accueil</a>
        <?php } ?>
        <a class="nav-link text-white" href="../client/accueil.php">Accueil</a>
        <a class="nav-link text-white" href="../client/reservationClient.php">Mes réservations</a>
        <a class="nav-link text-white" href="../client/profil.php">Profil</a>
    </div>
</nav>

<div class="container-resa">

    <div class="film-header">
        <?php
        $affiche = $film->getAffiche();
        if ($affiche != null && $affiche != "") { ?>
            <img src="<?= $affiche ?>" alt="<?= $film->getNom() ?>">
        <?php } ?>
        <div>
            <h2><?= $film->getNom() ?></h2>
            <div style="color:#aaa; font-size:0.9rem;"><?= $film->getGenre() ?> · <?= $film->getDuree() ?> min</div>
        </div>
    </div>

    <?php if ($succes != null) { ?>
        <div class="alert alert-success"><?= $succes ?></div>
        <div class="mt-3 text-center">
            <a href="../client/reservationClient.php" class="btn btn-outline-light btn-sm">Voir mes réservations</a>
        </div>
    <?php } else { ?>

        <?php if ($erreur != null) { ?>
            <div class="alert alert-danger"><?= $erreur ?></div>
        <?php } ?>

        <?php if (empty($seancesDuFilm)) { ?>
            <div class="alert alert-warning">Aucune séance disponible pour ce film.</div>
            <a href="../Films/ficheFilm.php?id=<?= $id_film ?>" class="btn btn-outline-light btn-sm">← Retour</a>
        <?php } else { ?>

            <form action="ajoutReservation.php" method="post">
                <input type="hidden" name="id_film" value="<?= $id_film ?>">

                <div class="mb-3">
                    <label class="form-label">Séance</label>
                    <select name="ref_seance" class="form-select" required>
                        <option value="">-- Choisir une séance --</option>
                        <?php foreach ($seancesDuFilm as $seance) { ?>
                            <option value="<?= $seance->getIdSeance() ?>">
                                <?= $seance->getDateSeance() ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Places plein tarif (15 €)</label>
                    <input type="number" name="qte_plein_tarif" id="qte_plein_tarif" class="form-control" min="0" value="0">
                </div>
                <div class="mb-3">
                    <label class="form-label">Places étudiant (10 €)</label>
                    <input type="number" name="qte_etudiant" id="qte_etudiant" class="form-control" min="0" value="0">
                </div>
                <div class="mb-3">
                    <label class="form-label">Places senior (5 €)</label>
                    <input type="number" name="qte_senior" id="qte_senior" class="form-control" min="0" value="0">
                </div>

                <div class="mb-3">
                    <label class="form-label">Code promo (facultatif)</label>
                    <input type="text" name="code_promo" class="form-control" placeholder="Ex : PROMO10">
                </div>



                <!-- PANIER -->
                <div id="panier" style="background:#1a1a1a; border:1px solid #444; border-radius:8px; padding:16px; margin-top:16px; display:none;">
                    <div style="color:#e50914; font-size:0.9rem; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:12px; font-weight:bold;">
                        🎟 Récapitulatif
                    </div>
                    <div id="panier-lignes"></div>
                    <div id="panier-total" style="display:none; justify-content:space-between; font-size:1rem; font-weight:bold; color:white; margin-top:10px; padding-top:10px; border-top:1px solid #e50914;">
                        <span>Total</span>
                        <span id="panier-montant">0 €</span>
                    </div>
                </div>
                <button type="submit" class="btn-reserver">Confirmer la réservation</button>
                <div class="mt-3 text-center">
                    <a href="../Films/ficheFilm.php?id=<?= $id_film ?>" class="btn btn-outline-light btn-sm">← Retour au film</a>
                </div>
            </form>

        <?php } ?>

    <?php } ?>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tarifs = [
            { id: 'qte_plein_tarif', label: 'Plein tarif', prix: 15 },
            { id: 'qte_etudiant',    label: 'Étudiant',    prix: 10 },
            { id: 'qte_senior',      label: 'Senior',       prix: 5  }
        ];

        function majPanier() {
            var total = 0;
            var html = '';

            tarifs.forEach(function (t) {
                var el = document.getElementById(t.id);
                var qte = el ? (parseInt(el.value) || 0) : 0;
                if (qte > 0) {
                    var sous = qte * t.prix;
                    total += sous;
                    html += '<div style="display:flex; justify-content:space-between; font-size:0.9rem; color:#ccc; padding:6px 0; border-bottom:1px solid #2a2a2a;">'
                        + '<span>' + qte + ' × ' + t.label + ' (' + t.prix + ' €)</span>'
                        + '<span>' + sous + ' €</span>'
                        + '</div>';
                }
            });

            var panier     = document.getElementById('panier');
            var lignesDiv  = document.getElementById('panier-lignes');
            var totalDiv   = document.getElementById('panier-total');
            var montantEl  = document.getElementById('panier-montant');

            if (html === '') {
                panier.style.display = 'none';
                totalDiv.style.display = 'none';
            } else {
                panier.style.display = 'block';
                lignesDiv.innerHTML = html;
                totalDiv.style.display = 'flex';
                montantEl.textContent = total + ' €';
            }
        }

        tarifs.forEach(function (t) {
            var el = document.getElementById(t.id);
            if (el) {
                el.addEventListener('input', majPanier);
                el.addEventListener('change', majPanier);
            }
        });
    });
</script>

</body>
</html>