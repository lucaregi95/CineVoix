<?php
require_once __DIR__ . '/../../src/bdd/Bdd.php';
require_once __DIR__ . '/../../src/modele/Acteurs.php';


if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['mdp'])){ /*&& isset($_POST['tel']) && isset($_POST['rue']) && isset($_POST['cp']) && isset($_POST['ville']) && isset($_POST['date_naissance'])) */
    $id_acteur = (isset($_POST['id_acteur'])) ? $_POST['id_acteur'] : null;
    $tel=(isset($_POST['tel']))&&($_POST['tel']!="")?$_POST['tel']:null;
    $rue = (isset($_POST['rue']))&&($_POST['rue']!="")?$_POST['rue']:null;
    $ville = (isset($_POST['ville']))&&($_POST['ville']!="")?$_POST['ville']:null;
    $cp = (isset($_POST['cp']))&&($_POST['cp']!="")?$_POST['cp']:null;
    $role = (isset($_POST['role']))&&($_POST['role']!="")?$_POST['role']:"user";
    $etat = (isset($_POST['etat']))&&($_POST['etat']!="")?$_POST['etat']:true;
    $date_naissance = (isset($_POST['date_naissance']))&&($_POST['date_naissance']!="")?$_POST['date_naissance']:null;
    $acteur = new Acteurs($id_acteur, $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $date_naissance, $tel, $rue, $ville, $cp,$role,$etat);
}
?>