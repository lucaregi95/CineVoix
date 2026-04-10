<?php
require_once __DIR__.'/../bdd/Bdd.php';
require_once __DIR__.'/../modele/CodePromo.php';


if(isset($_POST['code']) && isset($_POST['pourcentage_reduc'])){
    $code = new CodePromo(null, $_POST['code'], $_POST['pourcentage_reduc'], true);
}
?>