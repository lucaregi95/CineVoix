<?php


require_once "../../src/modele/Acteurs.php";
require_once "../../src/repository/ActeursRepository.php";
require_once "../../src/traitement/newActeurs.php";

if (isset($acteur)){
    $rep = new ActeursRepository();
    $rep -> ajouterActeur($acteur);
    header('Location: '.$_SERVER['PHP_SELF']);
    exit();
}

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
                <label>Nom :*</label>
                <input name="nom" id="nom" type="text" required><br />
            </div>
            <div class="mb-3">
                <label>Prénom :*</label>
                <input name="prenom" id="prenom" type="text" required><br />
            </div>
            <div class="mb-3">
                <label>Email :*</label>
                <input name="email" id="email" type="text" required><br />
            </div>
            <div class="mb-3">
                <label>Mot de passe :*</label>
                <input name="mdp" id="mdp" type="password" required><br />
            </div>
            <div class="mb-3">
                <label>Telephone :</label>
                <input name="tel" id="tel" type="tel"><br />
            </div>
            <div class="mb-3">
                <label>Rue :</label>
                <input name="rue" id="rue" type="text"><br />
            </div>
            <div class="mb-3">
                <label>Code Postal :</label>
                <input name="cp" id="cp" type="text" inputmode="numeric" pattern="[0-9]{5}" minlength="5" maxlength="5" placeholder="Ex : 75001"><br />
            </div>
            <div class="mb-3">
                <label>Ville :</label>
                <input name="ville" id="ville" type="text"><br />
            </div>
            <div class="mb-3">
                <label>Date de Naissance :</label>
                <input name="date_naissance" id="date_naissance" type="date"><br />
            </div>
            <button type="submit" name="submit_btn" value="S'inscire">Valider l'inscription</button>
        </div>
    </div>
</form>
</div>
</body>
</html>