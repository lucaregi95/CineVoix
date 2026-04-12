<?php

require_once "../../src/traitement/newCodePromo.php";
require_once "../../src/repository/CodePromoRepository.php";

if(isset($code)){
    $rep = new CodePromoRepository();
    $rep -> ajouterCodePromo($code);
    header('Location: '.$_SERVER['PHP_SELF'].'?message=Code Promo bien ajouté !');
    exit();
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Ajout Code Promo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<form action="ajoutCodePromo.php" method="post">
    <?php if(isset($_GET["message"])){?>
    <h5><?php echo $_GET["message"]?></h5>
    <?php }?>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Pourcentage de reduction :</label>
                <input type="number" name="pourcentage_reduc" step="0.01" min="0" placeholder="0.00" required>
            </div>
            <div class="mb-3">
                <label>Code :</label>
                <input name="code" id="prenom" type="text" required>
            </div>
            <button type="submit">Valider</button>


</form>
<form method="post" action="tabCodePromo.php">
    <button type="submit">Retour</button>
</form>

</body>
</html>

