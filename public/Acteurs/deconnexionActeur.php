<?php

session_start();

$_SESSION = [];

session_destroy();

header("Location: "); //definir ou est l'acceuil
exit;
?>