<?php
require_once '../bdd/Bdd.php';
require_once '../modele/CodePromo.php';


if(isset($_POST['code']) && isset($_POST['pourcentage_reduc'])){
    $code = new CodePromo(null, $_POST['code'], $_POST['pourcentage_reduc'], true);
}
?>