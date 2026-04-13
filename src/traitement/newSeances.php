<?php
require_once __DIR__.'/../bdd/Bdd.php';
require_once __DIR__.'/../modele/Seances.php';

if(isset($_POST['date_seance'])) {
    $seance = new Seances(null, $_POST['date_seance'], $_POST['ref_film'], $_POST['ref_salle']);
}
