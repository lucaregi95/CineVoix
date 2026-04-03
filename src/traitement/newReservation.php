<?php
require_once '../bdd/Bdd.php';
require_once '../modele/Reservation.php';

if (isset($_POST['statut']) && isset($_POST['qte_plein_tarif']) && isset($_POST['qte_etudiant']) && isset($_POST['qte_senior'])) {
    $reservation = new Reservation(null, $_POST['statut'], $_POST['qte_plein_tarif'], $_POST['qte_etudiant'], $_POST['qte_senior']);
}