<?php

require_once __DIR__ . '/../bdd/Bdd.php';
require_once __DIR__ . '/../modele/Reservation.php';

if (isset($_POST['statut']) && isset($_POST['qte_plein_tarif']) && isset($_POST['qte_etudiant']) && isset($_POST['qte_senior']) && isset($_POST["ref_seance"]) && isset($_POST["ref_acteur"])) {
    $id_reservation = (isset($_POST['id_reservation'])) ? $_POST['id_reservation'] : null;
    $moyen_paiement=(isset($_POST['moyen_paiement']))&&($_POST['moyen_paiement']!="")?$_POST['moyen_paiement']:null;
    $ref_code=(isset($_POST['ref_code']))&&($_POST['ref_code']!="")?$_POST['ref_code']:null;
    $reservation = new Reservation($id_reservation, $_POST['statut'], $_POST['qte_plein_tarif'], $_POST['qte_etudiant'], $_POST['qte_senior'], $moyen_paiement, $_POST['ref_seance'], $ref_code,$_POST['ref_acteur']);
}