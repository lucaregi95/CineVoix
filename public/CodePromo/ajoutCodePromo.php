<?php

require_once "../../src/traitement/newCodePromo.php";
require_once "../../src/repository/CodePromoRepository.php";

if(isset($code)){
    $rep = new CodePromoRepository();
    $rep -> ajouterCodePromo($code);
    header('Location: '.$_SERVER['PHP_SELF']);
    exit();
}
$_POST['pourcentage_reduc']=null;
$_POST['code']=null;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<form action="ajoutCodePromo.php" method="post">

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
</body>
</html>

