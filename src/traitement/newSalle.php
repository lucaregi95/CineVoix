<?php
require_once __DIR__.'/../bdd/Bdd.php';
require_once __DIR__.'/../modele/Salle.php';


if(isset($_POST['code']) && isset($_POST['nom']) && isset($_POST['capacite']) && isset($_POST['etat'])){
    $salle = new Salle ($_POST['id'], $_POST['code'], $_POST['nom'],$_POST['capacite'], $_POST['etat']);
}
else if(isset($_POST['code']) && isset($_POST['nom']) && isset($_POST['capacite'])){
    $salle = new Salle ($_POST['id'], $_POST['code'], $_POST['nom'],$_POST['capacite'], true);
}