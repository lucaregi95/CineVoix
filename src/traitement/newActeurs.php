<?php
require_once __DIR__ . '/../../src/bdd/Bdd.php';
require_once __DIR__ . '/../../src/modele/Acteurs.php';


if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['tel']) && isset($_POST['rue']) && isset($_POST['cp']) && isset($_POST['ville']) && isset($_POST['date_naissance']) && isset($_POST['role']) && isset($_POST['etat']) &&  isset($_POST['date_creation'])) {
    $acteur = new Acteurs(null, $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['date_naissance'], $_POST['tel'], $_POST['rue'], $_POST['ville'], $_POST['cp']);
}
?>