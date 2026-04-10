<?php

require_once "../../src/bdd/Bdd.php";
require_once "../../src/modele/Acteurs.php";
require_once "../../src/repository/ActeursRepository.php";

?>
<html>
<body>
<div class="form-ajout-acteur">
    <form action="ajoutActeur.php" method="post">
        <label>Nom :</label>
        <input name="nom" id="nom" type="text" required><br />
        <label>Prénom :</label>
        <input name="prenom" id="prenom" type="text" required><br />
        <label>Email :</label>
        <input name="email" id="email" type="text" required><br />
        <label>Mot de passe :</label>
        <input name="mdp" id="mdp" type="password" required><br />
        <label>Telephone :</label>
        <input name="tel" id="tel" type="tel" required><br />
        <label>Rue :</label>
        <input name="rue" id="rue" type="number" required><br />
        <label>Code Postal :</label>
        <input name="cp" id="cp" type="number" required><br />
        <label>Ville :</label>
        <input name="ville" id="ville" type="text" required><br />
        <label>Date de Naissance :</label>
        <input name="date_naissance" id="date_naissance" type="date" required><br />
        <label>Role :</label>
        <input name="role" id="role" type="text" required><br />
        <label>État :</label>
        <input name="etat" id="etat" type="number" required><br />
        <label>Date de Création :</label>
        <input name="date_creation" id="date_creation" type="date" required><br />
        <button type="submit" name="submit_btn" value="S'inscire">Valider l'inscription</button>
    </form>
</div>
</body>
</html>