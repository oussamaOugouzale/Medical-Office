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
    <script src="https://cdn.tailwindcss.com"></script>
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
                            <a href="<?= site_url('/logout') ?>">Se déconnecter</a>
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
                                    <img src="<?= esc(base_url('uploads/doctor.jpg')) ?>"
                                    alt="Photo du doctor">
                                    </a>
                                    <div class="profile-det-info">
                                        <h3>
                                            <a
                                                href="#"><?= esc(session()->get('doctor')['nom'] . ' ' . $session->get('doctor')['prenom']); ?></a>
                                        </h3>
                                        <div class="doctor-details">
                                            <h5 class="mb-0">ttttttttttttttest, somthinnnng</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-widget">
                                <nav class="dashboard-menu">
                                <ul>
                                        <li class="<?= (uri_string() == 'dashboard') ? 'active' : '' ?>">
                                            <a href="<?= base_url('dashboard') ?>">
                                                <i class="fa-solid fa-shapes"></i>
                                                <span>Dashboard</span>
                                            </a>
                                        </li>
                                        <li class="<?= (uri_string() == 'appointment') ? 'active' : '' ?>">
                                            <a href="<?= base_url('medecin-rdvs') ?>">
                                                <i class="fa-solid fa-calendar-days"></i>
                                                <span>Rendez-vous</span>
                                            </a>
                                        </li>
                                        <li class="<?= (uri_string() == 'profile-settings-hours') ? 'active' : '' ?>">
                                            <a href="<?= base_url('medecin-coordonnes') ?>">
                                                <i class="fa-solid fa-user-pen"></i>
                                                <span>Coordonnées</span>
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a href="<?= base_url('medecin-password') ?>">
                                                <i class="fa-solid fa-key"></i>
                                                <span>Mot de passe</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('logout') ?>">
                                                <i class="fa-solid fa-calendar-check"></i>
                                                <span>Se déconnecter</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="dashboard-header">
                            <h3>Changer le mot de passe</h3>
                        </div>
                        <form action="<?= base_url('/medecin-password-update') ?>" method="POST">
                            <?= csrf_field() ?>
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('success') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('error') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <div class="card pass-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-block input-block-new">
                                                <label class="form-label">Ancien mot de passe</label>
                                                <input type="password" name="oldPassword" class="form-control">
                                                <?php if (session('validation.oldPassword')): ?>
                                                    <div class="text-red-600 text-sm mt-1">
                                                        <?= session('validation')['oldPassword'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="input-block input-block-new">
                                                <label class="form-label" for="newPassword">Nouveau mot de passe</label>
                                                <div class="pass-group">
                                                    <input type="password" name="newPassword" class="form-control"
                                                        id="newPassword">
                                                </div>
                                                <?php if (session('validation.newPassword')): ?>
                                                    <div class="text-red-600 text-sm mt-1">
                                                        <?= session('validation')['newPassword'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="input-block input-block-new mb-0">
                                                <label class="form-label" for="newPassword_confirmation">Confirmer le
                                                    mot de passe</label>
                                                <div class="pass-group">
                                                    <input type="password" name="newPassword_confirmation"
                                                        class="form-control" id="newPassword_confirmation">
                                                </div>
                                                <?php if (session('validation.newPassword_confirmation')): ?>
                                                    <div class="text-red-600 text-sm mt-1">
                                                        <?= session('validation')['newPassword_confirmation'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-set-button">
                                <button class="btn btn-primary" type="submit">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function togglePasswordVisibility(inputName) {
            const input = document.querySelector(`input[name="${inputName}"]`);
            const eyeIcon = document.querySelector(`.toggle-password-${inputName}`);

            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.classList.add('feather-eye');
            } else {
                input.type = 'password';
                eyeIcon.classList.remove('feather-eye');
            }
        }

    </script>
    <script src="<?= base_url('public/assets/js/jquery-3.7.1.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/theia-sticky-sidebar/ResizeSensor.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/moment.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/bootstrap-datetimepicker.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/select2/js/select2.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/aos.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/script.js') ?>"></script>
</body>

</html>