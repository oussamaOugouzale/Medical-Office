<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Doccure</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?= base_url('assets/img/preview-banner.jpg') ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="<?= base_url('assets/img/preview-banner.jpg') ?>">
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="icon" href="<?= base_url('assets/img/favicon.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/fontawesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/feather.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/aos.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
</head>

<body>
    <div class="main-wrapper home-three">
        <header class="header header-trans header-three header-eight">
            <div class="container">
                <nav class="navbar navbar-expand-lg header-nav">
                    <div class="navbar-header">
                        <a id="mobile_btn" href="javascript:void(0);">
                            <span class="bar-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </a>
                        <a href="index-2.html" class="navbar-brand logo">
                            <img src="<?= base_url('assets/img/logo.png') ?>" class="img-fluid" alt="Logo">
                        </a>
                    </div>
                    <div class="main-menu-wrapper">
                        <div class="menu-header">
                            <a href="index-2.html" class="menu-logo">
                                <img src="<?= base_url('assets/img/logo-01.svg') ?>" class="img-fluid" alt="Logo">
                            </a>
                            <a id="menu_close" class="menu-close" href="javascript:void(0);">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <ul class="main-nav">
                            <li class="has-submenu megamenu active">
                                <a href="javascript:void(0);">Home </a>
                            </li>
                            <li class="has-submenu megamenu ">
                                <a href="javascript:void(0);">Contact </a>
                            </li>
                            <li class="has-submenu megamenu ">
                                <a href="javascript:void(0);">Qui sommes-nous ? </a>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav header-navbar-rht">
                        <li class="nav-item">
                            <a href="<?= base_url('logout') ?>">Se déconnecter</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="breadcrumb-bar-two">
            <div class="container">
                <div class="row align-items-center inner-banner">
                    <div class="col-md-12 col-12 text-center">
                        <h2 class="breadcrumb-title">Rendez-vous</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Rendez-vous</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Confirmation de Rendez-vous</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('sendCode') ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="motif">Motif de consultation</label>
                                    <input type="text" class="form-control" id="motif" name="motif" required>
                                    <?php if (session('errors.motif')): ?>
                                        <p class="text-red-500 text-xs italic"><?= session('errors.motif') ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="nom">Nom/Prénom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" required>
                                    <?php if (session('errors.nom')): ?>
                                        <p class="text-red-500 text-xs italic"><?= session('errors.nom') ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Numéro de téléphone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                    <small class="form-text text-muted">Format: 0XXXXXXXXX</small>
                                    <?php if (session('errors.phone')): ?>
                                        <p class="text-red-500 text-xs italic"><?= session('errors.phone') ?></p>
                                    <?php endif; ?>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Suivant</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
</body>

</html>