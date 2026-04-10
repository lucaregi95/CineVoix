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
    <title>Cinémoi - Liste Code Promo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<form method="post" action="ajoutCodePromo.php">
    <button>Ajouter</button>
</form>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Pourcentage de reduction</th>
            <th>Code de Reduction</th>
            <th>Etat</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($tabCodePromo as $codePromo){ ?>
        <tr>
            <td><?=$codePromo->getIdCodePromo()?></td>
            <td><?=$codePromo->getCodePromo()?></td>
            <td><?=$codePromo->getPourcentageReduction()?></td>
            <td><?=$codePromo->getEtat()?></td>
            <td>
                <form method="post" action="modificationCodePromo.php">
                    <button type="submit">Modifier</button>
                    <input type="hidden" name="id" value="<?=$codePromo->getIdCodePromo()?>">
                </form>
            </td>
            <td>
                <form method="post" action="suppressionCodePromo.php">
                    <button type="submit">Supprimer</button>
                    <input type="hidden" name="id" value="<?=$codePromo->getIdCodePromo()?>">
                </form>
            </td>
        </tr>
    </tbody>
    <?php } ?>
</table>
</body>
</html>

