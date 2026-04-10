<?php
require_once __DIR__.'/../bdd/Bdd.php';
require_once __DIR__.'/../modele/CodePromo.php';

if (isset($_POST['code']) && isset($_POST['pourcentage_reduc']) && isset($_POST['id']) && isset($_POST['etat'])) {
    $code = new CodePromo($_POST['id'], $_POST['code'], $_POST['pourcentage_reduc'], $_POST['etat']);
}else if (isset($_POST['code']) && isset($_POST['pourcentage_reduc']) && isset($_POST['id'])) {
    $code = new CodePromo($_POST['id'], $_POST['code'], $_POST['pourcentage_reduc'], true);
}
else if(isset($_POST['code']) && isset($_POST['pourcentage_reduc'])){
    $code = new CodePromo(null, $_POST['code'], $_POST['pourcentage_reduc'], true);
}
?>