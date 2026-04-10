<?php
require_once "../../src/traitement/newCodePromo.php";
require_once "../../src/repository/CodePromoRepository.php";
require_once "../../src/modele/CodePromo.php";
$rep = new CodePromoRepository();
$tabCodePromo = $rep -> getAllCodePromo();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Pourcentage de reduction</th>
            <th>Code de Reduction</th>
            <th>Etat</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($tabCodePromo as $codePromo){ ?>
        <tr>
            <td><?=$codePromo->getIdCodePromo()?></td>
            <td><?=$codePromo->getCodePromo()?></td>
            <td><?=$codePromo->getPourcentageReduction()?></td>
            <td><?=$codePromo->getEtat()?></td>
        </tr>
    </tbody>
    <?php } ?>
</table>
</body>
</html>

