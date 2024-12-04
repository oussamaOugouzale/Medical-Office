<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Admin - Doccure</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
</head>
<?php if (session()->get('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->get('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>
<?php if (session()->get('message')): ?>
    <div class="alert alert-success">
        <?= session()->get('message') ?>
    </div>
<?php endif; ?>

        <header class="header bg-white shadow-sm">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a href="/" class="navbar-brand">
                        <img src="assets/img/logo-01.svg" alt="Logo" height="40">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link text-primary fw-bold active" href="admin-home">Admin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="home">Log-out</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <body class="d-flex flex-column min-vh-100">
    <div class="main-wrapper flex-grow-1">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-4">Bienvenue sur l'espace administrateur</h2>
                    <p class="mb-4">Gérez facilement vos médecins depuis cet espace.</p>
                    <a href="/medecin-form" class="btn btn-primary mb-4">Ajouter un Médecin</a>

                    <!-- Table -->
                    <table class="table table-striped align-middle">
                            <thead>
                                <tr class="text-center">
                                    <th>Nom du Médecin</th>
                                    <th>Email</th>
                                    <th>Genre</th>
                                    <th>Spécialité</th>
                                    <th>Salle de Consultation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($medecins as $medecin) : ?>
                                    <tr>
                                        <td>Dr.<?= esc($medecin['nom']) . ' ' . esc($medecin['prenom']) ?></td>
                                        <td><?= esc($medecin['email']) ?></td>
                                        <td><?= esc($medecin['genre']) ?></td>
                                        <td><?= esc($medecin['specialite']) ?></td>
                                        <td><?= esc($medecin['salleConsultation']) ?></td>
                                        <td class="text-center">
                                            <a href="/medecin/edit/<?= esc($medecin['id']) ?>" class="btn btn-outline-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i> Modifier
                                            </a>
                                            <a href="/medecin/delete/<?= esc($medecin['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce médecin ?');">
                                                <i class="fas fa-trash-alt"></i> Supprimer
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer bg-primary text-white text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; 2024 Doccure. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
