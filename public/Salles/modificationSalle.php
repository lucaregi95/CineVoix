
<?php
require_once "../../src/traitement/newSalle.php";
require_once "../../src/repository/SalleRepository.php";

if(isset($_POST['id'])){
    $id = $_POST["id"];
}
else if (isset($_GET['id'])){
    $id = $_GET["id"];
}
$cpr = new SalleRepository();
if(isset($salle)){

    $cpr->modifierSalle($salle);
}

$o=$cpr->getSalle($id);






?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<form action="modificationSalle.php" method="post">

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Code :</label>
                <input name="code" type="text" value="<?php echo $o->getCode()?>" required>
            </div>
            <div class="mb-3">
                <label>Nom :</label>
                <input name="nom" type="text" value="<?php echo $o->getNom()?>" required>
            </div>
            <div class="mb-3">
                <label>Capacité :</label>
                <input type="number" name="capacite" step="1" min="0" value="<?php echo $o->getCapacite()?>" required>
            </div>
            <div class="mb-3">
                <label>Etat de la salle :</label>
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
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <button type="submit">Valider</button>
            <button formaction="tabSalle.php">Retour</button>


</form>
</body>





</html>
