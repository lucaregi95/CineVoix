<?php

require_once "../../src/traitement/newFilm.php";
require_once "../../src/repository/FilmRepository.php";
$id = $_POST["id"];

$rep = new FilmRepository();
$rep2 = $rep->getFilm($id);
if(isset($_POST["valide"])){
    if($_POST["valide"] == "oui"){
        $rep->supprimerFilm($rep2);
        header("Location: tabFilm.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Suppression Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <style>
        :root {
            --main-blue: #0d1b4c;
            --main-blue-light: #1d3b8b;
            --accent: #e50914;
        }
        body {
            background-color: #f0f2f8;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .confirm-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(13,27,76,0.13);
            padding: 2.5rem 2rem;
            max-width: 460px;
            width: 100%;
            text-align: center;
        }
        .danger-icon {
            width: 72px;
            height: 72px;
            background: #fff0f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: var(--accent);
        }
        .confirm-card h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--main-blue);
            margin-bottom: 0.5rem;
        }
        .confirm-card p {
            color: #6b7a9e;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }
        .film-name {
            color: var(--accent);
            font-weight: 700;
            font-size: 1.2rem;
        }
        .btn-danger-confirm {
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.7rem 2rem;
            font-weight: 600;
            font-size: 0.95rem;
            transition: opacity 0.2s;
            width: 100%;
            margin-bottom: 0.75rem;
        }
        .btn-danger-confirm:hover { opacity: 0.85; color: white; }
        .btn-back {
            background: white;
            color: var(--main-blue);
            border: 2px solid var(--main-blue);
            border-radius: 10px;
            padding: 0.7rem 2rem;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            display: block;
            transition: all 0.2s;
        }
        .btn-back:hover { background: var(--main-blue); color: white; }
    </style>
</head>
<body>

<div class="confirm-card">
    <div class="danger-icon">
        <i class="bi bi-trash3"></i>
    </div>

    <h2>Supprimer ce film ?</h2>
    <p>Vous êtes sur le point de supprimer définitivement<br>
        <span class="film-name"><?= htmlspecialchars($rep2->getNom()) ?></span>.<br>
        Cette action est irréversible.
    </p>

    <form action="suppressionFilm.php" method="post">
        <input type="hidden" value="oui" name="valide">
        <input type="hidden" value="<?= $id ?>" name="id">
        <button type="submit" class="btn-danger-confirm">
            <i class="bi bi-trash3 me-2"></i>Oui, supprimer
        </button>
    </form>

    <a href="tabFilm.php" class="btn-back">
        <i class="bi bi-arrow-left me-1"></i> Annuler
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>