<?php
require_once "../../src/traitement/newSalle.php";
require_once "../../src/repository/SalleRepository.php";

if(isset($salle)){
    $rep = new SalleRepository();
    $rep ->ajouterSalle($salle);
    header('Location: ajoutSalle.php');
    exit();
}


$_POST['code']=null;
$_POST['nom']=null;
$_POST['capacite']=null;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Ajout Salle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<form action="ajoutSalle.php" method="post">

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Code de la salle :</label>
                <input  name="code" id="code" type="text" required>
            </div>
            <div class="mb-3">
                <label>Nom de la salle :</label>
                <input name="nom" id="nom" type="text" required>
            </div>
            <div class="mb-3">
                <label>Capacité de la salle :</label>
                <input name="capacite" id="capacite" type="number" required>
            </div>
            <button type="submit">Valider</button>

</form>
</body>
</html>

