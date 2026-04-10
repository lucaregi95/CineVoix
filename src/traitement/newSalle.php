<?php
require_once __DIR__.'/../bdd/Bdd.php';
require_once __DIR__.'/../modele/Salle.php';

if(isset($_POST['code']) && isset($_POST['nom']) && isset($_POST['capacite'])){
    $salle = new Salle (null, $_POST['code'], $_POST['nom'],$_POST['capacite'], true);
}