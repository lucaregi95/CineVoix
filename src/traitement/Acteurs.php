<?php
require_once '../bdd/Bdd.php';
require_once '../modele/Acteurs.php';


if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date_naissance']) && isset($_POST['rue']) && isset($_POST['ville'])&&isset($_POST['cp']) && isset($_POST['email']) && isset($_POST['telephone'])){};
$acteur = new Acteurs(null, $_POST['nom'] , $_POST['prenom'], $_POST['date_naissance'], $_POST['rue'], $_POST['ville'], $_POST['cp'] , $_POST['email'] , $_POST['telephone']);