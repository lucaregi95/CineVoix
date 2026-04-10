<?php
require_once "../../src/repository/SeancesRepository.php";


 if(isset($seance)){
     $rep = new SeancesRepository();
     $rep -> ajouterReservation($seance);
     header('Location: '.$_SERVER['PHP_SELF']);
     exit();
 }

 $_POST['date_seance']= null;

 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<form action="ajoutSeance.php" method="post">

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>date de la séance :</label>
                <input type="date" name="date_seance" required>
            </div>
            <div class="mb-3">
                <label>ref film</label>
                <input type="text" name="ref_film" required>
            </div>
            <div class="mb-3">
                <label>ref_salle :</label>
                <input type="text" name="ref_salle" required>
            </div>
            <button type="submit">ajouter</button>

</form>
</body>
</html>
