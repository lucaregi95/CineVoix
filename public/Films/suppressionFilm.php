<?php

require_once "../../src/traitement/newFilm.php";
require_once "../../src/repository/FilmRepository.php";
$id=$_POST["id"];


$rep=new FilmRepository();
$rep2=$rep->getFilm($id);
if(isset($_POST["valide"])){
    if($_POST["valide"]=="oui"){
        $rep->supprimerFilm($rep2);
        header("Location: tabFilm.php");
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
<form action="suppressionFilm.php" method="post">
    <h2>Voulez-vous vraiment supprimer le film <?php echo $rep2->getNom(); ?> ?</h2>
    <button type="submit">Supprimer</button>
    <input type="hidden" value="oui" name="valide">
    <input type="hidden" value="<?php echo $id ?>" name="id">
    <button formaction="tabActeur.php">Retour</button>

</form>
</body>
</html>