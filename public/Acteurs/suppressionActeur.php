<?php

require_once "../../src/traitement/newActeurs.php";
require_once "../../src/repository/ActeursRepository.php";
$id=$_POST["id"];


$rep=new ActeursRepository();
$rep2=$rep->getActeur($id);
if(isset($_POST["valide"])){
    if($_POST["valide"]=="oui"){
        $rep->supprimerActeur($rep2);
        header("Location: tabActeur.php");
        exit;
    }}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Suppression Code Promo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<form action="suppressionActeur.php" method="post">
    <h2>Voulez-vous vraiment supprimer l'inscrit <?php echo $rep2->getNom(); echo " "; echo $rep2->getPrenom() ?> ?</h2>
    <button type="submit">Supprimer</button>
    <input type="hidden" value="oui" name="valide">
    <input type="hidden" value="<?php echo $id ?>" name="id">
    <button formaction="tabActeur.php">Retour</button>

</form>
</body>
</html>
