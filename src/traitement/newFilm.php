<?php
require_once '../bdd/Bdd.php';
require_once '../modele/Film.php';


if(isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['duree'])){
    $affiche=(isset($_POST['affiche']))?$_POST['affiche']:null;
    $genre=(isset($_POST['genre']))?$_POST['genre']:null;
    $age_min=(isset($_POST['age_min']))?$_POST['age_min']:null;
    $realisateur=(isset($_POST['realisateur']))?$_POST['realisateur']:null;
    $date_sortie=(isset($_POST['date_sortie']))?$_POST['date_sortie']:null;
    $bande_annonce=(isset($_POST['bande_annonce']))?$_POST['bande_annonce']:null;
    $film = new Film(null, $_POST['nom'],$_POST['description'],$_POST['duree'],$affiche,$genre,$age_min,$realisateur,$date_sortie,$bande_annonce);
}
?>
