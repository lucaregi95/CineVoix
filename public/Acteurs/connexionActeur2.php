<?php
require_once('../../src/bdd/Bdd.php');
require_once('../../src/modele/Acteurs.php');
require_once('../../src/repository/ActeursRepository.php');

// Récupération des données du formulaire de connexion
if (isset($_POST["email"])) {
    $email = $_POST["email"];
} else {
    $email = '';
}

if (isset($_POST["mdp"])) {
    $mdp = $_POST["mdp"];
} else {
    $mdp = '';
}

if(isset($_POST["page"])){
    $page  = $_POST["page"];}

// Requête préparée : sélectionne l'utilisateur correspondant
$rep = new ActeursRepository();
$result = $rep->connecterActeur($email, $mdp);

if (!$result) {
    header("Location: connexionActeur.php?erreur=selem");
    exit();
} else if ($result['etat']==0){
    header("Location: connexionActeur.php?erreur=bannir");
    exit();
} else if (!password_verify($mdp, $result['mdp'])) {
    header("Location: connexionActeur.php?erreur=unknown");
    exit();
}
else{

    session_start();
    // Stockage des informations de l'utilisateur en session
    $_SESSION['id']     = $result["id_acteur"];
    $_SESSION['nom']    = $result["nom"];
    $_SESSION['prenom'] = $result["prenom"];
    $_SESSION['email']  = $result["email"];
    $_SESSION['tel'] = $result["tel"];
    $_SESSION['rue']   = $result["rue"];
    $_SESSION['cp']   = $result["cp"];
    $_SESSION['ville']   = $result["ville"];
    $_SESSION['date_naissance']   = $result["date_naissance"];
    $_SESSION['role']   = $result["role"];
    $_SESSION['date_creation']   = $result["date_creation"];

    header('Location: ../client/accueil.php');




    ?>
    <!DOCTYPE html>
    <html lang=fr>
    <head>
        <meta charset="UTF-8">
        <title>Connexion en Cours</title>
    </head>
    <body>
    </body>
    </html>
<?php } ?>