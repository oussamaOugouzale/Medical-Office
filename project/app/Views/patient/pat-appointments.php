<?php

$session = session();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8">
    <title>Doccure</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?= base_url('assets/img/preview-banner.jpg'); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="<?= base_url('assets/img/preview-banner.jpg'); ?>">

    <link rel="icon" href="<?= base_url('assets/img/favicon.png'); ?>" type="image/x-icon">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/feather.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/aos.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">

    <style>
        .annule,
        .accepte {
            display: none;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <!-- Header -->
        <header class="header header-trans header-three header-eight">
            <div class="container">
                <nav class="navbar navbar-expand-lg header-nav">
                    <div class="navbar-header">
                        <!-- Bouton mobile -->
                        <a id="mobile_btn" href="javascript:void(0);">
                            <span class="bar-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </a>
                        <!-- Logo principal -->
                        <a href="<?= base_url('/') ?>" class="navbar-brand logo">
                            <img src="<?= base_url('assets/img/logo.png') ?>" class="img-fluid" alt="Logo">
                        </a>
                    </div>
                    <div class="main-menu-wrapper">
                        <div class="menu-header">
                            <!-- Logo pour le menu -->
                            <a href="<?= base_url('/') ?>" class="menu-logo">
                                <img src="<?= base_url('assets/img/logo-01.svg') ?>" class="img-fluid" alt="Logo">
                            </a>
                            <!-- Bouton fermer le menu -->
                            <a id="menu_close" class="menu-close" href="javascript:void(0);">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <ul class="main-nav">
                            <!-- Ajoutez ici des liens si nécessaire -->
                        </ul>
                    </div>
                    <ul class="nav header-navbar-rht">
                        <li class="nav-item">
                            <!-- Lien de déconnexion -->
                            <a href="<?= base_url('logout') ?>">Se déconnecter</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>


        <!-- Breadcrumb Bar -->
        <div class="breadcrumb-bar-two">
            <div class="container">
                <div class="row align-items-center inner-banner">
                    <div class="col-md-12 col-12 text-center">
                        <h2 class="breadcrumb-title"><?= $title ?? 'Page' ?></h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('/') ?>">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <?= $subtitle ?? 'Section' ?>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>




        <div class="content">
            <div class="container">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-lg-4 col-xl-3 theiaStickySidebar">
                        <div class="profile-sidebar doctor-sidebar profile-sidebar-new">
                            <!-- Section Profil -->
                            <div class="widget-profile pro-widget-content">
                                <div class="profile-info-widget">
                                    <a href="#" class="booking-doc-img">
                                        <img src="<?= esc(base_url(session()->get('patient.photo'))) ?>"
                                            alt="Photo du patient">

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
                                        <li class="active">
                                            <a href="<?= base_url('patient/dashboard'); ?>">
                                                <i class="fa-solid fa-calendar-days"></i>
                                                <span>Mes Rendez-vous</span>
                                            </a>
                                        </li>
                                        <li>
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




                        <div class="appointment-tab-head">
                            <div class="appointment-tabs">
                                <ul class="nav nav-pills inner-tab" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-upcoming-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-upcoming" type="button" role="tab"
                                            aria-controls="pills-upcoming" aria-selected="false">
                                            À venir<span><?= esc($aVenir); ?></span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-cancel-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-cancel" type="button" role="tab"
                                            aria-controls="pills-cancel" aria-selected="true">
                                            Annulé<span><?= esc($annule); ?></span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-complete-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-complete" type="button" role="tab"
                                            aria-controls="pills-complete" aria-selected="true">
                                            Complété<span><?= esc($complete); ?></span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content appointment-tab-content aVenir">
                            <div class="tab-pane fade show active" id="pills-upcoming" role="tabpanel"
                                aria-labelledby="pills-upcoming-tab">
                                <?php if (isset($rdvs) && !empty($rdvs)): ?>
                                    <?php foreach ($rdvs as $key => $rdv): ?>
                                        <?php if ($rdv['etat'] === "en attente"): ?>
                                            <div class="appointment-wrap">
                                                <ul>
                                                    <li>
                                                        <div class="patinet-information">
                                                            <a href="doctor-upcoming-appointment.html">
                                                                <img src="<?= base_url('assets/img/doctors-dashboard/profile-01.jpg'); ?>"
                                                                    alt="User Image">
                                                            </a>
                                                            <div class="patient-info">
                                                                <p>#Apt0001</p>
                                                                <h6><a href="doctor-upcoming-appointment.html">Dr
                                                                        <?php
                                                                        $doctorId = $rdv['doctor_id'];
                                                                        $medecinModel = new \App\Models\MedecinModel();
                                                                        $doctor = $medecinModel->find($doctorId);
                                                                        if ($doctor) {
                                                                            echo esc($doctor['nom']);
                                                                        } else {
                                                                            echo "Médecin introuvable.";
                                                                        }
                                                                        ?></a></h6>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="appointment-info">
                                                        <p><i class="fa-solid fa-clock"></i>
                                                            <?= esc($rdv['jour'] . ' ' . $rdv['horaire']); ?></p>
                                                        <ul class="d-flex apponitment-types">
                                                            <li><?= esc($rdv['motif']); ?></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mail-info-patient">
                                                        <ul>
                                                            <li><i class="fa-solid fa-envelope"></i>
                                                                <?php
                                                                $doctorId = $rdv['doctor_id'];
                                                                $medecinModel = new \App\Models\MedecinModel();
                                                                $doctor = $medecinModel->find($doctorId);
                                                                if ($doctor) {
                                                                    echo esc($doctor['email']);
                                                                } else {
                                                                    echo "Médecin introuvable.";
                                                                }
                                                                ?>
                                                            </li>
                                                            <li><i class="fa-solid fa-phone"></i>
                                                                <?php
                                                                $doctorId = $rdv['doctor_id'];
                                                                $medecinModel = new \App\Models\MedecinModel();
                                                                $doctor = $medecinModel->find($doctorId);
                                                                if ($doctor) {
                                                                    echo esc($doctor['telephone']);
                                                                } else {
                                                                    echo "Médecin introuvable.";
                                                                }
                                                                ?>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="appointment-detail-btn">
                                                        <a href="#" class="start-link">
                                                            <i class="fa-solid fa-calendar-check me-1">
                                                                <?= $rdv['etat'] === null ? 'Attend' : esc($rdv['etat']); ?>
                                                            </i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>Aucun rendez-vous à venir.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="tab-content appointment-tab-content annule">
                            <div class="tab-pane fade show active" id="pills-cancel" role="tabpanel"
                                aria-labelledby="pills-cancel-tab">
                                <?php if (isset($rdvs) && !empty($rdvs)): ?>
                                    <?php foreach ($rdvs as $rdv): ?>
                                        <?php if ($rdv['etat'] === 'annule'): ?>
                                            <div class="appointment-wrap">
                                                <ul>
                                                    <li>
                                                        <div class="patinet-information">
                                                            <a href="doctor-upcoming-appointment.html">
                                                                <img src="<?= base_url('assets/img/doctors-dashboard/profile-01.jpg'); ?>"
                                                                    alt="User Image">
                                                            </a>
                                                            <div class="patient-info">
                                                                <p>#Apt0001</p>
                                                                <h6><a href="doctor-upcoming-appointment.html">
                                                                        <?php
                                                                        $patientId = $rdv['patient_id'];
                                                                        $patientModel = new \App\Models\PatientModel();
                                                                        $patient = $patientModel->find($patientId);
                                                                        if ($patient) {
                                                                            echo esc($patient['nom']);
                                                                        } else {
                                                                            echo "patient introuvable.";
                                                                        }
                                                                        ?>
                                                                    </a>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="appointment-info">
                                                        <p><i class="fa-solid fa-clock"></i>
                                                            <?= esc($rdv['jour']) . ' ' . esc($rdv['horaire']); ?></p>
                                                        <ul class="d-flex apponitment-types">
                                                            <li><?= esc($rdv['motif']); ?></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mail-info-patient">
                                                        <ul>
                                                            <li><i class="fa-solid fa-envelope"></i>
                                                                <?php
                                                                $patientId = $rdv['patient_id'];
                                                                $patientModel = new \App\Models\PatientModel();
                                                                $patient = $patientModel->find($patientId);
                                                                if ($patient) {
                                                                    echo esc($patient['email']);
                                                                } else {
                                                                    echo "patient introuvable.";
                                                                }
                                                                ?>
                                                            </li>
                                                            <li><i class="fa-solid fa-phone"></i>
                                                                <?php
                                                                $patientId = $rdv['patient_id'];
                                                                $patientModel = new \App\Models\PatientModel();
                                                                $patient = $patientModel->find($patientId);
                                                                if ($patient) {
                                                                    echo esc($patient['telephone']);
                                                                } else {
                                                                    echo "patient introuvable.";
                                                                }
                                                                ?>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="appointment-detail-btn">
                                                        <a href="#" class="start-link">
                                                            <i class="fa-solid fa-calendar-check me-1">
                                                                <?= esc($rdv['etat']); ?>
                                                            </i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>Aucun rendez-vous annulé.</p>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="tab-content appointment-tab-content accepte">
                            <div class="tab-pane fade show active" id="pills-accepted" role="tabpanel"
                                aria-labelledby="pills-accepted-tab">
                                <?php if (isset($rdvs) && !empty($rdvs)): ?>
                                    <?php foreach ($rdvs as $rdv): ?>
                                        <?php if ($rdv['etat'] === 'accepte'): ?>
                                            <div class="appointment-wrap">
                                                <ul>
                                                    <li>
                                                        <div class="patinet-information">
                                                            <a href="doctor-upcoming-appointment.html">
                                                                <img src="<?= base_url('assets/img/doctors-dashboard/profile-01.jpg'); ?>"
                                                                    alt="User Image">
                                                            </a>
                                                            <div class="patient-info">
                                                                <p>#Apt<?= esc($rdv['id'] ?? '0001'); ?></p>
                                                                <h6>
                                                                    <a href="doctor-upcoming-appointment.html"><?php
                                                                    $patientId = $rdv['patient_id'];
                                                                    $patientModel = new \App\Models\PatientModel();
                                                                    $patient = $patientModel->find($patientId);
                                                                    if ($patient) {
                                                                        echo esc($patient['nom']);
                                                                    } else {
                                                                        echo "patient introuvable.";
                                                                    }
                                                                    ?></a>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="appointment-info">
                                                        <p><i class="fa-solid fa-clock"></i>
                                                            <?= esc($rdv['jour'] . ' ' . $rdv['horaire']); ?></p>
                                                        <ul class="d-flex apponitment-types">
                                                            <li><?= esc($rdv['motif']); ?></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mail-info-patient">
                                                        <ul>
                                                            <li><i class="fa-solid fa-envelope"></i>
                                                                <?php
                                                                $patientId = $rdv['patient_id'];
                                                                $patientModel = new \App\Models\PatientModel();
                                                                $patient = $patientModel->find($patientId);
                                                                if ($patient) {
                                                                    echo esc($patient['email']);
                                                                } else {
                                                                    echo "patient introuvable.";
                                                                }
                                                                ?>
                                                            </li>
                                                            <li><i class="fa-solid fa-phone"></i>
                                                                <?php
                                                                $patientId = $rdv['patient_id'];
                                                                $patientModel = new \App\Models\PatientModel();
                                                                $patient = $patientModel->find($patientId);
                                                                if ($patient) {
                                                                    echo esc($patient['telephone']);
                                                                } else {
                                                                    echo "patient introuvable.";
                                                                }
                                                                ?>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="appointment-detail-btn">
                                                        <a href="#" class="start-link">
                                                            <i class="fa-solid fa-calendar-check me-1">
                                                                <?= esc($rdv['etat']); ?>
                                                            </i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>Aucun rendez-vous accepté pour le moment.</p>
                                <?php endif; ?>
                            </div>
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
        <script src="<?= base_url('public/assets/js/jquery-3.7.1.min.js') ?>"></script>
        <script src="<?= base_url('public/assets/js/bootstrap.bundle.min.js') ?>"></script>
        <script src="<?= base_url('public/assets/plugins/theia-sticky-sidebar/ResizeSensor.js') ?>"></script>
        <script src="<?= base_url('public/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') ?>"></script>
        <script src="<?= base_url('public/assets/js/moment.min.js') ?>"></script>
        <script src="<?= base_url('public/assets/js/bootstrap-datetimepicker.min.js') ?>"></script>
        <script src="<?= base_url('public/assets/plugins/select2/js/select2.min.js') ?>"></script>
        <script src="<?= base_url('public/assets/js/aos.js') ?>"></script>
        <script src="<?= base_url('public/assets/js/script.js') ?>"></script>
        <script src="https://cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
            data-cf-settings="a3af23efa9a8f95e5c98a8cc-|49" defer></script>
</body>

</html>