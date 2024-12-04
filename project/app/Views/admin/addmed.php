<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Ajouter medcin - Doccure</title>
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
<body class="d-flex flex-column min-vh-100">

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

    <main class="flex-grow-1">
        <div class="container mt-5 pb-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-4">Ajouter un Médecin</h2>
                    <form action="/create-medecin" method="POST">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du Médecin</label>
                            <input type="text" name="nom" class="form-control" id="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="nom" class="form-label">Prenom du Médecin</label>
                            <input type="text" name="prenom" class="form-control" id="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="salle_consoltation" class="form-label">Specialite</label>
                            <input type="text" name="specialite" class="form-control" id="specialite" required>
                        </div>
                        <div class="mb-3">
                            <label for="salle_consoltation" class="form-label">Numero de telephone</label>
                            <input type="text" name="telephone" class="form-control" id="numero_de_telephone" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre</label>
                            <select name="genre" class="form-control" id="genre" required>
                                <option value="Homme">Homme</option>
                                <option value="Femme">Femme</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="salle_consoltation" class="form-label">Salle de Consultation</label>
                            <input type="text" name="salleConsultation" class="form-control" id="salle_consoltation" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" name="motDePasse" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter Médecin</button>
                        <a href="<?= base_url('/admin-home')?>" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer bg-primary text-white text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; 2024 Doccure. Tous droits réservés.</p>
        </div>
    </footer>


    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>