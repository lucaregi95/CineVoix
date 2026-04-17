<?php
require_once "../../src/traitement/newActeurs.php";
require_once "../../src/repository/ActeursRepository.php";



if (isset($_POST['id'])) {
    $id_acteur = $_POST['id'];
} elseif (isset($_GET['id'])) {
    $id_acteur = $_GET['id'];
}


$cpr = new ActeursRepository();
if(isset($acteur)){
    $cpr->modifierActeur($acteur);



}

$o=$cpr->getActeur($id_acteur);




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
                <input name="mdp" type="password" value="<?php echo $o->getMdp()?>" required>
            </div>
            <div class="mb-3">
                <label>Telephone :</label>
                <input name="tel" type="tel" value="<?php echo $o->getTelephone()?>" >
            </div>
            <div class="mb-3">
                <label>Rue :</label>
                <input name="rue" type="text" value="<?php echo $o->getRue()?>" >
            </div>
            <div class="mb-3">
                <label>Code Postal :</label>
                <input name="cp" type="number" value="<?php echo $o->getCp()?>" >
            </div>
            <div class="mb-3">
                <label>Ville :</label>
                <input name="ville" type="text" value="<?php echo $o->getVille()?>" required>
            </div>
            <div class="mb-3">
                <label>Date de naissance :</label>
                <input name="date_naissance" type="date" value="<?php echo $o->getDateNaissance()?>" >
            </div>

            <div class="mb-3">
                <label>Role :</label>
                <?php if ($o->getRole()=="user"){?>
                    <select name="role">
                        <option value="user">Utilisateur</option>
                        <option value="accueil">Accueil</option>
                        <option value="admin">Administrateur</option>
                    </select>
                <?php } else if ($o->getRole()=="accueil"){?>
                    <select name="role">
                        <option value="accueil">Accueil</option>
                        <option value="user">Utilisateur</option>
                        <option value="admin">Administrateur</option>
                    </select>
                <?php } else{?>
                    <select name="role">
                        <option value="admin">Administrateur</option>
                        <option value="accueil">Accueil</option>
                        <option value="user">Utilisateur</option>
                    </select>
                <?php } ?>
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
                <input name="date_creation" type="text" value="<?php echo $o->getDateCreation()?>" disabled>
            </div>

            <input type="hidden" name="id_acteur" value="<?php echo $id_acteur?>">
            <button type="submit">Valider</button>
            <button formaction="tabActeur.php">Retour</button>


</form>
</body>





</html>