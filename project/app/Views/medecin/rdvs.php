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
                        <a href="<?= base_url('/') ?>" class="navbar-brand logo">
                            <img src="<?= base_url('assets/img/logo.png') ?>" class="img-fluid" alt="Logo">
                        </a>
                    </div>
                    <div class="main-menu-wrapper">
                        <div class="menu-header">
                            <a href="<?= base_url('/') ?>" class="menu-logo">
                                <img src="<?= base_url('assets/img/logo-01.svg') ?>" class="img-fluid" alt="Logo">
                            </a>
                            <a id="menu_close" class="menu-close" href="javascript:void(0);">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <ul class="main-nav"></ul>
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
                                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
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
                                        <img src="<?= esc(base_url('uploads/doctor.jpg')) ?>" alt="User Image">
                                    </a>
                                    <div class="profile-det-info">
                                        <h3>
                                            <a href="#">
                                                Dr <?= session('doctor.nom') . ' ' . session('doctor.prenom') ?>
                                            </a>
                                        </h3>
                                        <div class="patient-details">
                                            <h5 class="mb-0">Test, Something</h5>
                                        </div>
                                        <?php
                                        $doctorId = session()->get('doctor.id'); // Récupération de l'ID du docteur
                                        $specialitesModel = new \App\Models\SpecialiteModel(); // Chargement du modèle SpecialiteModel
                                        $specialite = $specialitesModel->where('doctor_id', $doctorId)->first(); // Recherche de la spécialité correspondante
                                        
                                        if ($specialite): ?>
                                            <span class="badge doctor-role-badge">
                                                <i class="fa-solid fa-circle"></i>
                                                <?= esc($specialite['specialite']) ?>
                                            </span>
                                        <?php endif; ?>
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
                                        <li class="active">
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
                                        <li class="<?= (uri_string() == 'doctor-password') ? 'active' : '' ?>">
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
                        <h3>Rendez-vous</h3>
                    </div>

                    <div class="appointment-tab-head">
                        <div class="appointment-tabs">
                            <ul class="nav nav-pills inner-tab" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-upcoming-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-upcoming" type="button" role="tab"
                                        aria-controls="pills-upcoming" aria-selected="false">
                                        A venir<span><?= isset($aVenir) ? $aVenir : 0 ?></span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-cancel-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-cancel" type="button" role="tab"
                                        aria-controls="pills-cancel" aria-selected="true">
                                        Annulé<span><?= isset($annule) ? $annule : 0 ?></span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-complete-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-complete" type="button" role="tab"
                                        aria-controls="pills-complete" aria-selected="true">
                                        Complété<span><?= isset($complete) ? $complete : 0 ?></span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-content appointment-tab-content">
                        <div class="tab-pane fade show active" id="pills-upcoming" role="tabpanel"
                            aria-labelledby="pills-upcoming-tab">
                            <?php if (isset($rdvs)): ?>
                                <?php foreach ($rdvs as $rdv): ?>
                                    <?php if ($rdv['etat'] === 'en attente'): ?>
                                        <div class="appointment-wrap">
                                            <ul>
                                                <li>
                                                    <div class="patinet-information">
                                                        <a href="#">
                                                            <img src="<?php
$patientId = $rdv['patient_id']; 
$patientModel = new \App\Models\PatientModel();
$patient = $patientModel->find($patientId); 

if ($patient): ?>
        <?= esc(base_url($patient['photo'])) ?>
<?php endif; ?>" alt="User Image">
                                                        </a>
                                                        <div class="patient-info">
                                                        <p>#<?= $rdv['patient_id'] ?></p>
                                                        <?php
                                                                    $patientId = $rdv['patient_id'];
                                                                    $patientModel = new \App\Models\PatientModel();
                                                                    $patient = $patientModel->find($patientId);

                                                                    if ($patient): ?>
                                                                        <a href="#">
                                                                            <?= esc($patient['nom'] ?? '') ?>
                                                                        </a>
                                                                        <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="appointment-info">
                                                    <p><i class="fa-solid fa-clock"></i><?= $rdv['jour'] . ' ' . $rdv['horaire'] ?>
                                                    </p>
                                                    <ul class="d-flex apponitment-types">
                                                        <li><?= $rdv['motif'] ?></li>
                                                    </ul>
                                                </li>
                                                <li class="mail-info-patient">
                                                    <ul>
                                                        <li><i class="fa-solid fa-envelope"></i><?php
                                                                    $patientId = $rdv['patient_id'];
                                                                    $patientModel = new \App\Models\PatientModel();
                                                                    $patient = $patientModel->find($patientId);

                                                                    if ($patient): ?>
                                                                            <?= esc($patient['email'] ?? '') ?>
                                                                        <?php endif; ?>
                                                                    </li>
                                                        <li><i class="fa-solid fa-phone"></i><?php
                                                                    $patientId = $rdv['patient_id'];
                                                                    $patientModel = new \App\Models\PatientModel();
                                                                    $patient = $patientModel->find($patientId);

                                                                    if ($patient): ?>
                                                                            <?= esc($patient['telephone'] ?? '') ?>
                                                                        <?php endif; ?>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <div class="tab-pane fade" id="pills-cancel" role="tabpanel" aria-labelledby="pills-cancel-tab">
                            <?php if (isset($rdvs)): ?>
                                <?php foreach ($rdvs as $rdv): ?>
                                    <?php if ($rdv['etat'] === 'annule'): ?>
                                        <div class="appointment-wrap">
                                            <ul>
                                                <li>
                                                    <div class="patinet-information">
                                                        <a href="#">
                                                            <img src="<?php
$patientId = $rdv['patient_id']; 
$patientModel = new \App\Models\PatientModel();
$patient = $patientModel->find($patientId); 

if ($patient): ?>
        <?= esc(base_url($patient['photo'])) ?>
<?php endif; ?>" alt="User Image">
                                                        </a>
                                                        <div class="patient-info">
                                                        <p>#<?= $rdv['patient_id'] ?></p>
                                                        <?php
                                                                    $patientId = $rdv['patient_id'];
                                                                    $patientModel = new \App\Models\PatientModel();
                                                                    $patient = $patientModel->find($patientId);

                                                                    if ($patient): ?>
                                                                        <a href="#">
                                                                            <?= esc($patient['nom'] ?? '') ?>
                                                                        </a>
                                                                        <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="appointment-info">
                                                    <p><i class="fa-solid fa-clock"></i><?= $rdv['jour'] . ' ' . $rdv['horaire'] ?>
                                                    </p>
                                                    <ul class="d-flex apponitment-types">
                                                        <li><?= $rdv['motif'] ?></li>
                                                    </ul>
                                                </li>
                                                <li class="mail-info-patient">
                                                    <ul>
                                                        <li><i class="fa-solid fa-envelope"></i><?php
                                                                    $patientId = $rdv['patient_id'];
                                                                    $patientModel = new \App\Models\PatientModel();
                                                                    $patient = $patientModel->find($patientId);

                                                                    if ($patient): ?>
                                                                            <?= esc($patient['email'] ?? '') ?>
                                                                        <?php endif; ?>
                                                                    </li>
                                                        <li><i class="fa-solid fa-phone"></i><?php
                                                                    $patientId = $rdv['patient_id'];
                                                                    $patientModel = new \App\Models\PatientModel();
                                                                    $patient = $patientModel->find($patientId);

                                                                    if ($patient): ?>
                                                                            <?= esc($patient['telephone'] ?? '') ?>
                                                                        <?php endif; ?>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <div class="tab-pane fade" id="pills-complete" role="tabpanel"
                            aria-labelledby="pills-complete-tab">
                            <?php if (isset($rdvs)): ?>
                                <?php foreach ($rdvs as $rdv): ?>
                                    <?php if ($rdv['etat'] === 'accepte'): ?>
                                        <div class="appointment-wrap">
                                            <ul>
                                                <li>
                                                    <div class="patinet-information">
                                                        <a href="#">
                                                            <img src="<?php
$patientId = $rdv['patient_id']; 
$patientModel = new \App\Models\PatientModel();
$patient = $patientModel->find($patientId); 

if ($patient): ?>
        <?= esc(base_url($patient['photo'])) ?>
<?php endif; ?>" alt="User Image">
                                                        </a>
                                                        <div class="patient-info">
                                                            <p>#<?= $rdv['patient_id'] ?></p>
                                                                    <?php
                                                                    $patientId = $rdv['patient_id'];
                                                                    $patientModel = new \App\Models\PatientModel();
                                                                    $patient = $patientModel->find($patientId);

                                                                    if ($patient): ?>
                                                                        <a href="#">
                                                                            <?= esc($patient['nom'] ?? '') ?>
                                                                        </a>
                                                                        <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="appointment-info">
                                                    <p><i class="fa-solid fa-clock"></i><?= $rdv['jour'] . ' ' . $rdv['horaire'] ?>
                                                    </p>
                                                    <ul class="d-flex apponitment-types">
                                                        <li><?= $rdv['motif'] ?></li>
                                                    </ul>
                                                </li>
                                                <li class="mail-info-patient">
                                                    <ul>
                                                        <li><i class="fa-solid fa-envelope"></i><?php
                                                                    $patientId = $rdv['patient_id'];
                                                                    $patientModel = new \App\Models\PatientModel();
                                                                    $patient = $patientModel->find($patientId);

                                                                    if ($patient): ?>
                                                                            <?= esc($patient['email'] ?? '') ?>
                                                                        <?php endif; ?>
                                                                    </li>
                                                        <li><i class="fa-solid fa-phone"></i><?php
                                                                    $patientId = $rdv['patient_id'];
                                                                    $patientModel = new \App\Models\PatientModel();
                                                                    $patient = $patientModel->find($patientId);

                                                                    if ($patient): ?>
                                                                            <?= esc($patient['telephone'] ?? '') ?>
                                                                        <?php endif; ?>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                </div>

                
            </div>
        </div>
    </div>
                <script>
        document.addEventListener('DOMContentLoaded', function() {
            const upcomingButton = document.getElementById('pills-upcoming-tab');
            const cancelButton = document.getElementById('pills-cancel-tab');
            const completeButton = document.getElementById('pills-complete-tab');

            const aVenirDiv = document.querySelector('.aVenir');
            const annuleDiv = document.querySelector('.annule');
            const accepteDiv = document.querySelector('.accepte');

            upcomingButton.addEventListener('click', function() {
                aVenirDiv.style.display = 'block';
                annuleDiv.style.display = 'none';
                accepteDiv.style.display = 'none';
                upcomingButton.classList.add('active');
                cancelButton.classList.remove('active');
                completeButton.classList.remove('active');
            });

            cancelButton.addEventListener('click', function() {
                aVenirDiv.style.display = 'none';
                annuleDiv.style.display = 'block';
                accepteDiv.style.display = 'none';
                cancelButton.classList.add('active');
                upcomingButton.classList.remove('active');
                completeButton.classList.remove('active');
            });

            completeButton.addEventListener('click', function() {
                aVenirDiv.style.display = 'none';
                annuleDiv.style.display = 'none';
                accepteDiv.style.display = 'block';
                completeButton.classList.add('active');
                upcomingButton.classList.remove('active');
                cancelButton.classList.remove('active');
            });
        });
    </script>
    <script src="<?= base_url('assets/js/jquery-3.7.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') ?>"></script>
    <script src="<?= base_url('assets/js/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-datetimepicker.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/select2/js/select2.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/aos.js') ?>"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>
</html>