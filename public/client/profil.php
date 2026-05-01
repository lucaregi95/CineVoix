<?php

session_start();

require_once "../../src/bdd/Bdd.php";
require_once "../../src/modele/Acteurs.php";
require_once "../../src/repository/ActeursRepository.php";

$rep = new ActeursRepository();
//$id_acteur = $_SESSION['id'];
$id_acteur = 1 ;

if (isset($_POST['nom'])) {
    $acteurActuel = $rep->getActeur($id_acteur);

    $mdp = !empty($_POST['mdp']) ? $_POST['mdp'] : $acteurActuel->getMdp();

    $acteur = new Acteurs(
        $id_acteur,
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['email'],
        $mdp,
        $_POST['date_naissance'],
        $_POST['tel'],
        $_POST['rue'],
        $_POST['ville'],
        $_POST['cp'],
        $acteurActuel->getRole(),
        $acteurActuel->getEtat()
    );

    $rep->modifierActeur($acteur);
    header("Location: profil.php?id=" . $id_acteur . "&success=1");
    exit();
}

$o = $rep->getActeur($id_acteur);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-sm navbar-light bg-light border border-danger border-3">
    <div class="container d-flex justify-content-evenly align-items-center">

        <a class="nav-link" href="specialistes.php">Spécialistes</a>
        <a class="nav-link" href="forum.php">Forum</a>
        <a class="nav-link" href="aides.php">Aides</a>
        <a class="nav-link" href="presentation.php">Handicaps</a>

    </div>
</nav>


<div class="container py-5" style="max-width: 700px;">
    <h4 class="mb-4">Mon profil</h4>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            Modifications enregistrées avec succès.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="profil.php" method="POST">
                <h6 class="text-muted mb-3">Informations personnelles</h6>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($o->getNom()) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($o->getPrenom()) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($o->getEmail()) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Téléphone</label>
                        <input type="tel" name="tel" class="form-control" value="<?= htmlspecialchars($o->getTelephone()) ?>">
                    </div>
                </div>

                <hr>

                <h6 class="text-muted mb-3">Adresse</h6>
                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <label class="form-label">Rue</label>
                        <input type="text" name="rue" class="form-control" value="<?= htmlspecialchars($o->getRue()) ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Code postal</label>
                        <input type="text" name="cp" class="form-control" value="<?= htmlspecialchars($o->getCp()) ?>" maxlength="6">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Ville</label>
                        <input type="text" name="ville" class="form-control" value="<?= htmlspecialchars($o->getVille()) ?>" required>
                    </div>
                </div>

                <hr>

                <h6 class="text-muted mb-3">Compte</h6>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Date de naissance</label>
                        <input type="date" name="date_naissance" class="form-control" value="<?= htmlspecialchars($o->getDateNaissance()) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Rôle</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($o->getRole()) ?>" disabled>
                        <div class="form-text">Non modifiable</div>
                    </div>
                </div>

                <hr>

                <h6 class="text-muted mb-3">
                    Mot de passe
                    <span class="fw-normal text-muted">(laisser vide pour ne pas modifier)</span>
                </h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="mdp" id="mdp1" class="form-control" placeholder="••••••••">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirmer</label>
                        <input type="password" name="mdp_confirm" id="mdp2" class="form-control" placeholder="••••••••">
                    </div>
                    <div class="col-12">
                        <div id="pw-error" class="text-danger small" style="display:none;"></div>
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-end">
                    <a href="accueil.php" class="btn btn-outline-secondary">Retour</a>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const mdp1 = document.getElementById('mdp1').value;
        const mdp2 = document.getElementById('mdp2').value;
        const err  = document.getElementById('pw-error');
        if (mdp1 || mdp2) {
            if (mdp1 !== mdp2) {
                e.preventDefault();
                err.textContent = 'Les mots de passe ne correspondent pas.';
                err.style.display = 'block';
                return;
            }
            if (mdp1.length < 6) {
                e.preventDefault();
                err.textContent = 'Le mot de passe doit contenir au moins 6 caractères.';
                err.style.display = 'block';
                return;
            }
        }
        err.style.display = 'none';
    });
</script>
</body>
</html>