<?php
require_once "../../src/traitement/newActeurs.php";
require_once "../../src/repository/ActeursRepository.php";

$id_Acteur = null;

if (isset($_POST['id'])) {
    $id_Acteur = $_POST['id'];
} elseif (isset($_GET['id'])) {
    $id_Acteur = $_GET['id'];
}

if ($id_Acteur === null) {
    header("Location: listeActeurs.php");
    exit();
}

$cpr = new ActeursRepository();
if(isset($acteur)){
    $cpr->modifierActeur($acteur);
}

$o=$cpr->getActeur($id_Acteur);






?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Modification Acteur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<form action="modificationActeur.php" method="post">

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Nom :</label>
                <input type="text" name="nom" step="0.01" min="0" value="<?php echo $o->getNom()?>" required>
            </div>
            <div class="mb-3">
                <label>Prenom :</label>
                <input name="prenom" type="text" value="<?php echo $o->getPrenom()?>" required>
            </div>
            <div class="mb-3">
                <label>Email :</label>
                <input name="email" type="email" value="<?php echo $o->getEmail()?>" required>
            </div>
            <div class="mb-3">
                <label>Mot de passe :</label>
                <input name="mot_de_passe" type="password" value="<?php echo $o->getMdp()?>" required>
            </div>
            <div class="mb-3">
                <label>Telephone :</label>
                <input name="tel" type="tel" value="<?php echo $o->getTelephone()?>" required>
            </div>
            <div class="mb-3">
                <label>Rue :</label>
                <input name="rue" type="number" value="<?php echo $o->getRue()?>" required>
            </div>
            <div class="mb-3">
                <label>Code Postal :</label>
                <input name="code_postal" type="number" value="<?php echo $o->getCp()?>" required>
            </div>
            <div class="mb-3">
                <label>Ville :</label>
                <input name="ville" type="text" value="<?php echo $o->getVille()?>" required>
            </div>
            <div class="mb-3">
                <label>Date de naissance :</label>
                <input name="date_naissance" type="date" value="<?php echo $o->getDateNaissance()?>" required>
            </div>
            <div class="mb-3">
                <label>Role :</label>
                <input name="role" type="text" value="<?php echo $o->getRole()?>" required>
            </div>
            <div class="mb-3">
                <label>Etat :</label>
                <input name="etat" type="text" value="<?php echo $o->getEtat()?>" required>
            </div>
            <div class="mb-3">
                <label>Etat :</label>
                <?php if ($o->getEtat()==1){?>
                    <select name="etat">
                        <option value="1">Actif</option>
                        <option value="0">Inactif</option>
                    </select>
                <?php } else {?>
                    <select name="etat">
                        <option value="0">Inactif</option>
                        <option value="1">Actif</option>
                    </select>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label>Date de creation :</label>
                <input name="date_creation" type="text" value="<?php echo $o->getDateCreation()?>" required>
            </div>
            <input type="hidden" name="id" value="<?php echo $id_Acteur ?>">
            <button type="submit">Valider</button>
            <button formaction="tabCodePromo.php">Retour</button>


</form>
</body>





</html>