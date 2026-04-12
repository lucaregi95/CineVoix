<?php

require_once "../../src/traitement/newCodePromo.php";
require_once "../../src/repository/CodePromoRepository.php";
$id=$_POST["id"];


$rep=new CodePromoRepository();
$rep2=$rep->getCodePromo($id);
if(isset($_POST["valide"])){
if($_POST["valide"]=="oui"){
    $rep->supprimerCodePromo($rep2);
    header("Location: tabCodePromo.php");
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
<form action="suppressionCodePromo.php" method="post">
    <h2>Voulez-vous vraiment supprimer le code promo <?php echo $rep2->getCodePromo() ?> </h2>
    <button type="submit">Supprimer</button>
    <input type="hidden" value="oui" name="valide">
    <input type="hidden" value="<?php echo $id ?>" name="id">
    <button formaction="tabCodePromo.php">Retour</button>

</form>
</body>
</html>

