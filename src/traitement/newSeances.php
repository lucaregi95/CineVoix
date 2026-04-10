<?php
require_once '../bdd/Bdd.php';
require_once '../modele/Seances.php';

if(isset($_POST['date_seance'])) {
    $seance = new Seances(null, $_POST['date_seance'], $_POST['ref_film'], $_POST['ref_salle']);
}
