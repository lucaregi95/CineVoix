<?php
require_once "../../src/traitement/newFilm.php";
require_once "../../src/repository/FilmRepository.php";

if(isset($film)){
    $rep = new FilmRepository();
    $rep -> ajouterFilm($film);
    header('Location: '.$_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cinémoi - Ajout Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <style>
        :root {
            --main-blue: #0d1b4c;
            --main-blue-light: #1d3b8b;
            --accent: #093ce5;
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

        .form-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(13,27,76,0.1);
            padding: 2rem;
        }

        .section-title {
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--main-blue);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #eef2fb;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #2c3a5e;
            margin-bottom: 0.35rem;
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 0.65rem 0.9rem;
            border: 1.5px solid #dde3f0;
            font-size: 0.875rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--main-blue-light);
            box-shadow: 0 0 0 0.2rem rgba(29,59,139,0.12);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .input-icon {
            position: relative;
        }
        .input-icon i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #aab2cc;
            font-size: 0.9rem;
            pointer-events: none;
        }
        .input-icon .form-control {
            padding-left: 2.2rem;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--main-blue), var(--main-blue-light));
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.7rem 2rem;
            font-weight: 600;
            font-size: 0.95rem;
            transition: opacity 0.2s;
        }
        .btn-submit:hover { opacity: 0.88; color: white; }

        .btn-back {
            background: white;
            color: var(--main-blue);
            border: 2px solid var(--main-blue);
            border-radius: 10px;
            padding: 0.7rem 2rem;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        .btn-back:hover { background: var(--main-blue); color: white; }

        .required-note {
            font-size: 0.78rem;
            color: #8892b0;
        }
        .required-note span { color: var(--accent); }
    </style>
</head>
<body>

<!-- HEADER -->
<div class="page-header">
    <div class="container" style="max-width:780px;">
        <h1><i class="bi bi-plus-circle me-2"></i>Ajouter un film</h1>
        <p>Administration · Cinémoi</p>
    </div>
</div>

<div class="container pb-5" style="max-width:780px;">

    <div class="form-card">
        <p class="required-note mb-4">Les champs marqués <span>*</span> sont obligatoires.</p>

        <form action="ajoutFilm.php" method="post">


            <p class="section-title"><i class="bi bi-info-circle me-1"></i>Informations principales</p>
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <label class="form-label">Nom du film <span style="color:var(--accent)">*</span></label>
                    <div>
                        <input type="text" name="nom" class="form-control" placeholder="Ex : Inception" required>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label">Description <span style="color:var(--accent)">*</span></label>
                    <textarea name="description" class="form-control" placeholder="Synopsis du film..." required></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Réalisateur</label>
                    <div>
                        <input type="text" name="realisateur" class="form-control" placeholder="Ex : Christopher Nolan">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Genre</label>
                    <div>
                        <input type="text" name="genre" class="form-control" placeholder="Ex : Science-fiction">
                    </div>
                </div>
            </div>

            <p class="section-title"><i class="bi bi-sliders me-1"></i>Détails</p>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label">Durée <span style="color:var(--accent)">*</span></label>
                    <div>
                        <input type="time" name="duree" class="form-control" value="00:00" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Âge minimum</label>
                    <div>
                        <input type="number" name="age_min" class="form-control" placeholder="Ex : 12" min="0" max="18">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Date de sortie <span style="color:var(--accent)">*</span></label>
                    <input type="date" name="date_sortie" class="form-control" required>
                </div>
            </div>

            <p class="section-title"><i class="bi bi-images me-1"></i>Médias</p>
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <label class="form-label">URL de l'affiche</label>
                    <div>
                        <input type="url" name="affiche" class="form-control" placeholder="https://...">
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label">URL de la bande-annonce</label>
                    <div>
                        <input type="url" name="bande_annonce" class="form-control" placeholder="https://youtube.com/...">
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 justify-content-end pt-2">
                <a href="tabFilm.php" class="btn-back">
                    <i class="bi bi-arrow-left me-1"></i> Retour
                </a>
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-lg me-1"></i> Valider
                </button>
            </div>

        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>