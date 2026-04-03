<?php
require_once '../bdd/Bdd.php';
require_once '../modele/SeancesRepository.php';

if(isset($_POST['date_seance'])){
    $seance = new Seances(null, $_POST['date_seance']);
}