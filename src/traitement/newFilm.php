<?php
require_once __DIR__.'/../bdd/Bdd.php';
require_once __DIR__.'/../modele/Film.php';



if(isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['duree'])){

    $duree = $_POST['duree'];
    list($h, $m) = explode(':', $duree);
    $duree=$h*60+$m;

    $id_film = (isset($_POST['id_film'])) ? $_POST['id_film'] : null;
    $affiche=(isset($_POST['affiche']))&&($_POST['affiche']!="")?$_POST['affiche']:null;
    $genre=(isset($_POST['genre']))&&($_POST['genre']!="")?$_POST['genre']:null;
    $age_min=(isset($_POST['age_min']))&&($_POST['age_min']!="")?$_POST['age_min']:null;
    $realisateur=(isset($_POST['realisateur']))&&($_POST['realisateur']!="")?$_POST['realisateur']:null;
    $date_sortie=(isset($_POST['date_sortie']))&&($_POST['date_sortie']!="")?$_POST['date_sortie']:null;
    $bande_annonce=(isset($_POST['bande_annonce']))&&($_POST['bande_annonce']!="")?$_POST['bande_annonce']:null;
    $film = new Film($id_film, $_POST['nom'],$_POST['description'],$duree,$affiche,$genre,$age_min,$realisateur,$date_sortie,$bande_annonce);
    //$filmRepository = new FilmRepository();
    // $reponse = $filmRepository->ajouterFilm($film);
    //if($reponse){

    //}else{

    //}

}
?>
