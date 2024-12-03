<?php $session = session(); ?>



<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <title>Doccure</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?= base_url('assets/img/preview-banner.jpg') ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="<?= base_url('assets/img/preview-banner.jpg') ?>">
    <title>Doccure</title>

    <link rel="icon" href="<?= base_url('assets/img/favicon.png') ?>" type="image/x-icon">

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/fontawesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/all.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/feather.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/aos.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
    <style>
        .annule,
        .accepte {
            display: none;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
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
                        <a href="<?= base_url('index-2.html') ?>" class="navbar-brand logo">
                            <img src="<?= base_url('assets/img/logo.png') ?>" class="img-fluid" alt="Logo">
                        </a>
                    </div>
                    <div class="main-menu-wrapper">
                        <div class="menu-header">
                            <a href="<?= base_url('index-2.html') ?>" class="menu-logo">
                                <img src="<?= base_url('assets/img/logo-01.svg') ?>" class="img-fluid" alt="Logo">
                            </a>
                            <a id="menu_close" class="menu-close" href="javascript:void(0);">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <ul class="main-nav">

                        </ul>
                    </div>
                    <ul class="nav header-navbar-rht">
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/logout') ?>">Se déconnecter</a>
                    </ul>
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
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Rdv</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-xl-3 theiaStickySidebar">
                        <div class="profile-sidebar doctor-sidebar profile-sidebar-new">
                            <div class="widget-profile pro-widget-content">
                                <div class="profile-info-widget">
                                    <a href="#" class="booking-doc-img">
                                        <img src="<?= esc(base_url(session()->get('patient.photo'))) ?>"
                                            alt="Photo du patient">
                                    </a>
                                    <div class="profile-det-info">
                                        <h3>
                                            <a
                                                href="#"><?= esc(session()->get('patient')['nom'] . ' ' . $session->get('patient')['prenom']); ?></a>
                                        </h3>
                                        <div class="patient-details">
                                            <h5 class="mb-0">ttttttttttttttest, somthinnnng</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu du tableau de bord -->
                            <div class="dashboard-widget">
                                <nav class="dashboard-menu">
                                    <ul>
                                        <li class="">
                                            <a href="<?= base_url('patient/dashboard'); ?>">
                                                <i class="fa-solid fa-calendar-days"></i>
                                                <span>Mes Rendez-vous</span>
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a href="<?= base_url('/patient-profile-settings'); ?>">
                                                <i class="fa-solid fa-user-pen"></i>
                                                <span>Paramétre du profil</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('/password'); ?>">
                                                <i class="fa-solid fa-key"></i>
                                                <span>Mot de passe</span>
                                            </a>
                                        </li>
                                        <li>
                                            <form action="<?= base_url('logout'); ?>" method="post">
                                                <a href="javascript:void(0);" onclick="this.closest('form').submit();">
                                                    <i class="fa-solid fa-calendar-check"></i>
                                                    <span>Se déconnecter</span>
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="dashboard-header">
                            <h3>Rendez-vous</h3>
                        </div>
                        <form action="<?= base_url('patient-profile-settings-update') ?>" method="POST"
                            enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="setting-card">
                                <?php if (session('success')): ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?= session('success') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                <?php endif ?>
                                <?php if (session('error')): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?= session('error') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                <?php endif ?>
                                <div class="change-avatar img-upload">
                                    <div class="profile-img">
                                        <i class="fa-solid fa-file-image" id="icon"></i>
                                        <img id="preview" src="<?= esc($patient['photo']) ?>" alt="Image de Profil"
                                            style="display: none; max-width: 100px; max-height: 100px;" />
                                    </div>
                                    <div class="upload-img">
                                        <h5>Image de Profil</h5>
                                        <div class="imgs-load d-flex align-items-center">
                                            <div class="change-photo">
                                                Importer une image
                                                <input type="file" required class="upload" name="photo"
                                                    accept=".jpg, .png, .svg" onchange="previewImage(event)">
                                            </div>
                                        </div>
                                        <p class="form-text">Votre image doit être inférieure à 4 Mo, formats acceptés :
                                            jpg, png, svg</p>
                                    </div>
                                </div>
                            </div>

                            <div class="setting-title">
                                <h5>INFORMATIONS PERSONELLES</h5>
                            </div>
                            <div class="setting-card">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Genre <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" required name="genre">
                                                <option value="" disabled <?= empty($patient['genre']) ? 'selected' : '' ?>>Genre</option>
                                                <option value="homme" <?= ($patient['genre'] === 'homme') ? 'selected' : '' ?>>Homme</option>
                                                <option value="femme" <?= ($patient['genre'] === 'femme') ? 'selected' : '' ?>>Femme</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Nom <span class="text-danger">*</span></label>
                                            <input type="text" value="<?= esc($patient['nom']) ?>" required name="nom"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Prénom <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" value="<?= esc($patient['prenom']) ?>" required
                                                name="prenom" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">numéro de téléphone <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" value="<?= esc($patient['telephone']) ?>" required
                                                name="numero_tel" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Adresse email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" value="<?= esc($patient['email']) ?>" required
                                                name="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Age <span class="text-danger">*</span></label>
                                            <input type="text" value="<?= esc($patient['age']) ?>" required name="age"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-btn text-end">
                                <button type="submit" class="btn btn-primary prime-btn">Enregister</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const upcomingButton = document.getElementById('pills-upcoming-tab');
            const cancelButton = document.getElementById('pills-cancel-tab');
            const completeButton = document.getElementById('pills-complete-tab');

            const aVenirDiv = document.querySelector('.aVenir');
            const annuleDiv = document.querySelector('.annule');
            const accepteDiv = document.querySelector('.accepte');

            upcomingButton.addEventListener('click', function () {
                aVenirDiv.style.display = 'block';
                annuleDiv.style.display = 'none';
                accepteDiv.style.display = 'none';
                upcomingButton.classList.add('active');
                const completeButton = document.getElementById('pills-complete-tab');
                const cancelButton = document.getElementById('pills-cancel-tab');
                cancelButton.classList.remove('active');
                completeButton.classList.remove('active');
            });

            cancelButton.addEventListener('click', function () {
                aVenirDiv.style.display = 'none';
                annuleDiv.style.display = 'block';
                accepteDiv.style.display = 'none';
                cancelButton.classList.add('active');
                const upcomingButton = document.getElementById('pills-upcoming-tab');
                const completeButton = document.getElementById('pills-complete-tab');
                upcomingButton.classList.remove('active');
                completeButton.classList.remove('active');
            });

            completeButton.addEventListener('click', function () {
                aVenirDiv.style.display = 'none';
                annuleDiv.style.display = 'none';
                accepteDiv.style.display = 'block';

                completeButton.classList.add('active');
                const upcomingButton = document.getElementById('pills-upcoming-tab');
                const cancelButton = document.getElementById('pills-cancel-tab');
                upcomingButton.classList.remove('active');
                cancelButton.classList.remove('active');
            });
        });

    </script>
    <script src="{{ asset('public/assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
    <script src="{{ asset('public/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/aos.js') }}"></script>
    <script src="{{ asset('public/assets/js/script.js') }}"></script>
    <script src="../../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="a3af23efa9a8f95e5c98a8cc-|49" defer></script>
</body>


</html>