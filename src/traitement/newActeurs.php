<?php

require_once '../bdd/Bdd.php';

require_once '../modele/Acteurs.php';


    $rue = null;
    $cp = null;
    $ville = null;
    $date_naissance = null;
    $telephone = null;

    if (isset($_POST['rue'])) {
        $affiche = $_POST['rue'];
    }
    if (isset($_POST['cp'])) {
        $genre = $_POST['cp'];
    }
    if (isset($_POST['ville'])) {
        $age_min = $_POST['ville'];
    }
    if (isset($_POST['telephone'])) {
        $realisateur = $_POST['telephone'];
    }
    if (isset($_POST['mdp'])) {
        $mdp = $_POST['mdp'];
    }
    $acteur = new Acteurs(null, $_POST['nom'] , $_POST['prenom'], $_POST['date_naissance'], $_POST['rue'], $_POST['ville'], $_POST['cp'] , $_POST['email'] , $_POST['telephone'] , $_POST['mdp']);