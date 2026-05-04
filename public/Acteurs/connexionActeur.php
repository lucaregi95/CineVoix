<?php

require_once('../../src/bdd/Bdd.php');

$nom=null;
$prenom=null;
$email=null;
if(isset($_POST['email'])){
    $email=$_POST['email'];
}
$erreur=null;
$inscription=null;
if(isset($_GET['erreur'])){
    if ($_GET['erreur']=='unknown'){
        $erreur="Identifiants inexistants ou incorrects.";
    }if ($_GET['erreur']=='bannir'){
        $erreur="Votre compte a été banni.";
    }

}

if(isset($_GET['page'])){
    $page=$_GET['page'];

}
$inscription="Pas de compte ? Inscrivez-vous";
?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="UTF-8">
<title>Cinémoi - Connexion</title>
<body>
<div>
    <div>
        <div>
            <form method="POST" action="connexionActeur2.php">
                <label for="email">Adresse e-mail :</label><br>
                <input type="email" id="email" name="email" value="<?=$email?>" autocomplete="off" required><br><br>

                <label for="mdp">Mot de Passe :</label><br>
                <input type="password" id="mdp" name="mdp" autocomplete="off" required><br>

                <?php if (isset($page)) {?>
                    <input type="hidden" value="<?=$page?>" name="page">
                <?php } ?>
                <h6><?=$erreur?></h6>

                <button type="submit">Connectez-vous !</button><br><br>
            </form>
            <div class="mb-3">
                <a href="ajoutActeur.php"><?=$inscription?></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>