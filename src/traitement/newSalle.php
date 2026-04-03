<?php
require_once '../bdd/Bdd.php';
require_once '../modele/Salle.php';

if(isset($_POST['code']) && isset($_POST['nom']) && isset($_POST['capacite']) && isset($_POST['etat'])){
    $salle = new Salle ($_POST['code'], $_POST['nom'], $_POST['capacite'], $_POST['etat']);
}