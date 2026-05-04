<?php
require_once "../../src/traitement/newFilm.php";
require_once "../../src/repository/FilmRepository.php";
require_once "../../src/modele/Film.php";
$rep = new FilmRepository();
$tabFilm = $rep -> getAllFilm();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Liste des films</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <style>
        :root {
            --main-blue: #0d1b4c;
            --main-blue-light: #1d3b8b;
            --accent: #0935e5;
        }

        body {
            background-color: #f0f2f8;
            font-family: 'Segoe UI', sans-serif;
        }

        .page-header {
            background: linear-gradient(135deg, var(--main-blue), var(--main-blue-light));
            color: white;
            padding: 2rem 2.5rem;
            border-radius: 0 0 20px 20px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(13,27,76,0.2);
        }

        .page-header h1 {
            font-size: 1.6rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: 0.03em;
        }

        .page-header p {
            margin: 0.25rem 0 0;
            opacity: 0.7;
            font-size: 0.9rem;
        }

        .card-table {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(13,27,76,0.1);
            border: none;
        }

        .table {
            margin: 0;
        }

        .table thead {
            background-color: var(--main-blue);
            color: white;
        }

        .table thead th {
            font-weight: 600;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            padding: 1rem 1rem;
            border: none;
            white-space: nowrap;
        }

        .table tbody tr {
            border-bottom: 1px solid #e8ecf5;
            transition: background 0.15s;
        }

        .table tbody tr:hover {
            background-color: #eef2fb;
        }

        .table tbody td {
            padding: 0.85rem 1rem;
            vertical-align: middle;
            font-size: 0.875rem;
            color: #2c3a5e;
            border: none;
        }

        .badge-genre {
            background-color: #eef2fb;
            color: var(--main-blue);
            font-weight: 600;
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .badge-age {
            background-color: #fff3cd;
            color: #7a5800;
            font-weight: 600;
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .film-id {
            font-weight: 700;
            color: #aab2cc;
            font-size: 0.8rem;
        }

        .film-title {
            font-weight: 600;
            color: var(--main-blue);
        }

        .film-desc {
            color: #6b7a9e;
            font-size: 0.82rem;
            max-width: 220px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .btn-modify {
            background-color: var(--main-blue);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 5px 12px;
            font-size: 0.8rem;
            font-weight: 500;
            transition: background 0.2s;
        }
        .btn-modify:hover { background-color: var(--main-blue-light); color: white; }

        .btn-delete {
            background-color: #fff0f0;
            color: var(--accent);
            border: 1.5px solid #ffc8c8;
            border-radius: 8px;
            padding: 5px 12px;
            font-size: 0.8rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-delete:hover { background-color: var(--accent); color: white; border-color: var(--accent); }

        .btn-add {
            background: linear-gradient(135deg, var(--main-blue), var(--main-blue-light));
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.4rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: opacity 0.2s;
        }
        .btn-add:hover { opacity: 0.88; color: white; }

        .btn-back {
            background: white;
            color: var(--main-blue);
            border: 2px solid var(--main-blue);
            border-radius: 10px;
            padding: 0.6rem 1.4rem;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-back:hover { background: var(--main-blue); color: white; }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(13,27,76,0.08);
        }
        .empty-state i { font-size: 3rem; color: #c5cde8; margin-bottom: 1rem; display: block; }
        .empty-state h4 { color: var(--main-blue); font-weight: 600; }
        .empty-state p { color: #8892b0; }

        .affiche-path {
            font-size: 0.75rem;
            color: #8892b0;
            max-width: 120px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .trailer-link {
            color: var(--accent);
            font-size: 0.8rem;
            text-decoration: none;
            font-weight: 500;
        }
        .trailer-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="page-header">
    <div class="container-fluid px-2">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1><i class="bi bi-film me-2"></i>Gestion des films</h1>
                <p>Administration · Cinémoi</p>
            </div>
            <div class="d-flex gap-2">
                <a href="../client/accueil.php" class="btn-back">
                    <i class="bi bi-arrow-left me-1"></i> Retour
                </a>
                <form method="post" action="ajoutFilm.php" class="d-inline">
                    <button type="submit" class="btn-add">
                        <i class="bi bi-plus-lg me-1"></i> Ajouter un film
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-4 pb-5">

    <?php if(!empty($tabFilm)): ?>

        <p class="text-muted mb-3" style="font-size:0.875rem;">
            <i class="bi bi-collection-play me-1"></i>
            <strong><?= count($tabFilm) ?></strong> film(s) répertorié(s)
        </p>

        <div class="card card-table">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th><i class="bi bi-clock me-1"></i>Durée</th>
                        <th>Affiche</th>
                        <th>Genre</th>
                        <th>Âge min.</th>
                        <th>Réalisateur</th>
                        <th><i class="bi bi-calendar3 me-1"></i>Sortie</th>
                        <th>Bande-annonce</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($tabFilm as $film): ?>
                        <tr>
                            <td><span class="film-id"><?= $film->getIdFilm() ?></span></td>
                            <td><span class="film-title"><?= $film->getNom() ?></span></td>
                            <td><span class="film-desc" title="<?= htmlspecialchars($film->getDescription()) ?>"><?= $film->getDescription() ?></span></td>
                            <td><?= $film->getDuree() ?> min</td>
                            <td><span class="affiche-path" title="<?= $film->getAffiche() ?>"><?= $film->getAffiche() ?: '—' ?></span></td>
                            <td><span class="badge-genre"><?= $film->getGenre() ?></span></td>
                            <td><span class="badge-age"><?= $film->getAgeMin() ?>+</span></td>
                            <td><?= $film->getRealisateur() ?></td>
                            <td><?= $film->getDateSortie() ?></td>
                            <td>
                                <?php if($film->getBandeAnnonce()): ?>
                                    <a href="<?= $film->getBandeAnnonce() ?>" target="_blank" class="trailer-link">
                                        <i class="bi bi-play-circle me-1"></i>Voir
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <form method="post" action="modificationFilm.php">
                                        <button type="submit" class="btn-modify">
                                            <i class="bi bi-pencil me-1"></i>Modifier
                                        </button>
                                        <input type="hidden" name="id" value="<?= $film->getIdFilm() ?>">
                                    </form>
                                    <form method="post" action="suppressionFilm.php">
                                        <button type="submit" class="btn-delete">
                                            <i class="bi bi-trash me-1"></i>Supprimer
                                        </button>
                                        <input type="hidden" name="id" value="<?= $film->getIdFilm() ?>">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php else: ?>

        <div class="empty-state">
            <i class="bi bi-film"></i>
            <h4>Aucun film pour le moment</h4>
            <p>Commencez par ajouter votre premier film au catalogue.</p>
            <form method="post" action="ajoutFilm.php" class="d-inline">
                <button type="submit" class="btn-add mt-2">
                    <i class="bi bi-plus-lg me-1"></i> Ajouter un film
                </button>
            </form>
        </div>

    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>