<?php
require_once "../../src/traitement/newSeances.php";
require_once "../../src/repository/SeancesRepository.php";
require_once "../../src/traitement/newFilm.php";
require_once "../../src/repository/FilmRepository.php";
require_once "../../src/traitement/newSalle.php";
require_once "../../src/repository/SalleRepository.php";



 if(isset($seance)){
     $rep = new SeancesRepository();
     $all = $rep -> getAllSeances();
     $compteur=0;
     foreach($all as $seanceall){
         if ($seance->getDateSeance() == $seanceall->getDateSeance() && $seance->getRefSalle() == $seanceall->getRefSalle()){
             $compteur++;


     }}
     if ($compteur>0){
         header('Location: '.$_SERVER['PHP_SELF']."?message=Il y'a déja une séance ce jour dans cette salle.");
         exit();
     }else {
         $rep->ajouterSeance($seance);
         header('Location: ' . $_SERVER['PHP_SELF']);
         exit();
     }
 }

 $_POST['date_seance']= null;
$rep2 = new FilmRepository();
$films = $rep2 -> getAllFilm();

$rep3 = new SalleRepository();
$salles = $rep3 -> getAllSalle();


$date = new DateTimeImmutable();
$date = $date->modify('+1 day'); // ➜ ajoute 1 jour
$dateMin = $date->format('Y-m-d');
 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<?php if(isset($_GET['message'])){?>
<h4><?=$_GET["message"]?></h4>
<?php } ?>
<form action="ajoutSeance.php" method="post">

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Date de la séance :</label>
                <input type="date" name="date_seance" min="<?=$dateMin?>" required>
            </div>
            <div class="mb-3">
                <label>Film :</label>
                <select name="ref_film" required>
                    <option value="">--Veuillez selectionner un film--</option>
                    <?php foreach ($films as $film){?>
                    <option value="<?= $film->getIdFilm() ?>"><?=$film->getNom()?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Salle :</label>
                <select name="ref_salle" required>
                    <option value="">--Veuillez selectionner une salle--</option>
                    <?php foreach ($salles as $salle){?>
                        <option value="<?= $salle->getIdSalle() ?>"><?=$salle->getNom()?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit">Ajouter</button>

</form>
<form method="post" action="tabSeance.php">
    <button type="submit">Retour</button>
</form>
</body>
</html>
