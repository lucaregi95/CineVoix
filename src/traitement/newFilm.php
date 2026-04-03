<?php
require_once '../bdd/Bdd.php';
require_once '../modele/Film.php';


if(isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['duree'])){
    $affiche=null;
    $genre=null;
    $age_min=null;
    $realisateur=null;
    $date_sortie=null;
    $bande_annonce=null;
    if (isset($_POST['affiche'])){
        $affiche=$_POST['affiche'];
    }
    if (isset($_POST['genre'])){
        $affiche=$_POST['genre'];
    }
    if (isset($_POST['age_min'])){
        $affiche=$_POST['age_min'];
    }
    if (isset($_POST['realisateur'])){
        $affiche=$_POST['realisateur'];
    }
    if (isset($_POST['date_sortie'])){
        $affiche=$_POST['date_sortie'];
    }
    if (isset($_POST['bande_annonce'])){
        $affiche=$_POST['bande_annonce'];
    }
    $film = new Film(null, $_POST['nom'],$_POST['description'],$_POST['duree'],$affiche,$genre,$age_min,$realisateur,$date_sortie,$bande_annonce);
}
?>
