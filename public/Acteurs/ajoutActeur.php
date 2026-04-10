<?php

require_once "../../src/bdd/Bdd.php";
require_once "../../src/modele/Acteurs.php";
require_once "../../src/repository/ActeursRepository.php";
require_once "../../src/traitement/newActeurs.php";

if (isset($acteur)){
    $rep = new ActeursRepository();
    $rep -> ajouterActeur($acteur);
    header('Location: '.$_SERVER['PHP_SELF']);
    exit();
}
//sert a ce que quand on rafraichis ca ne remet pas dans la bdd
$_POST['nom']=null;
$_POST['prenom']=null;
$_POST['email']=null;
$_POST['mdp']=null;
$_POST['tel']=null;
$_POST['rue']=null;
$_POST['cp']=null;
$_POST['ville']=null;
$_POST['date_naissance']=null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Ajout Acteur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<form action="ajoutActeur.php" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Nom :</label>
                <input name="nom" id="nom" type="text" required><br />
            </div>
            <div class="mb-3">
                <label>Prénom :</label>
                <input name="prenom" id="prenom" type="text" required><br />
            </div>
            <div class="mb-3">
                <label>Email :</label>
                <input name="email" id="email" type="text" required><br />
            </div>
            <div class="mb-3">
                <label>Mot de passe :</label>
                <input name="mdp" id="mdp" type="password" required><br />
            </div>
            <div class="mb-3">
                <label>Telephone :</label>
                <input name="tel" id="tel" type="tel" required><br />
            </div>
            <div class="mb-3">
                <label>Rue :</label>
                <input name="rue" id="rue" type="number" required><br />
            </div>
            <div class="mb-3">
                <label>Code Postal :</label>
                <input name="cp" id="cp" type="number" required><br />
            </div>
            <div class="mb-3">
                <label>Ville :</label>
                <input name="ville" id="ville" type="text" required><br />
            </div>
            <div class="mb-3">
                <label>Date de Naissance :</label>
                <input name="date_naissance" id="date_naissance" type="date" required><br />
            </div>
            <button type="submit" name="submit_btn" value="S'inscire">Valider l'inscription</button>
        </div>
    </div>
</form>
</div>
</body>
</html>