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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="main-wrapper home-three">

        <!-- Header -->
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
                        <a href="<?= base_url() ?>" class="navbar-brand logo">
                            <img src="<?= base_url('assets/img/logo.png') ?>" class="img-fluid" alt="Logo">
                        </a>
                    </div>
                    <div class="main-menu-wrapper">
                        <div class="menu-header">
                            <a href="<?= base_url() ?>" class="menu-logo">
                                <img src="<?= base_url('assets/img/logo-01.svg') ?>" class="img-fluid" alt="Logo">
                            </a>
                            <a id="menu_close" class="menu-close" href="javascript:void(0);">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <ul class="main-nav">
                            <!-- Ajoutez des éléments de menu ici si nécessaire -->
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
        <!-- /Header -->

        <!-- Breadcrumb -->
        <div class="breadcrumb-bar-two">
            <div class="container">
                <div class="row align-items-center inner-banner">
                    <div class="col-md-12 col-12 text-center">
                        <h2 class="breadcrumb-title">Dashboard</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->

        <div class="content">
            <div class="container">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-lg-4 col-xl-3 theiaStickySidebar">
                        <div class="profile-sidebar doctor-sidebar profile-sidebar-new">
                            <div class="widget-profile pro-widget-content">
                                <div class="profile-info-widget">
                                    <a href="" class="booking-doc-img">
                                        <img src="<?= esc(base_url('uploads/doctor.jpg')) ?>" alt="User Image">
                                    </a>
                                    <div class="profile-det-info">
                                        <h3>
                                            <a href="">
                                                Dr <?= session()->get('doctor.nom') ?>
                                                <?= session()->get('doctor.prenom') ?>
                                            </a>
                                        </h3>
                                        <div class="patient-details">
                                            <h5 class="mb-0">Test, something</h5>
                                        </div>
                                        <?php
                                        $doctorId = session()->get('doctor.id'); // Récupération de l'ID du docteur
                                        $specialitesModel = new \App\Models\SpecialiteModel(); // Chargement du modèle SpecialiteModel
                                        $specialite = $specialitesModel->where('doctor_id', $doctorId)->first(); // Recherche de la spécialité correspondante
                                        
                                        if ($specialite): ?>
                                            <span class="badge doctor-role-badge">
                                                <i class="fa-solid fa-circle"></i>
                                                <?= esc($specialite['specialite']) ?>
                                                <?php if (!empty($specialite['autre_specialite'])): ?>
                                                    / <?= esc($specialite['autre_specialite']) ?>
                                                <?php endif; ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="badge doctor-role-badge">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-widget">
                                <nav class="dashboard-menu">
                                    <ul>
                                        <li class="active">
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
                    <!-- /Sidebar -->
                    <div class="col-lg-8 col-xl-9">
                        <div class="row">
                            <div class="col-xl-4 d-flex">
                                <div class="dashboard-box-col w-100">
                                    <div class="dashboard-widget-box">
                                        <div class="dashboard-content-info">
                                            <h6>Total Patients</h6>
                                            <h4><?= isset($totalRdv) ? $totalRdv : 0 ?></h4>
                                        </div>
                                        <div class="dashboard-widget-icon">
                                            <span class="dash-icon-box"><i class="fa-solid fa-user-injured"></i></span>
                                        </div>
                                    </div>
                                    <div class="dashboard-widget-box">
                                        <div class="dashboard-content-info">
                                            <h6>Patients aujourd'hui</h6>
                                            <h4><?= isset($patientsToday) ? $patientsToday : 0 ?></h4>
                                        </div>
                                        <div class="dashboard-widget-icon">
                                            <span class="dash-icon-box"><i class="fa-solid fa-user-clock"></i></span>
                                        </div>
                                    </div>
                                    <div class="dashboard-widget-box">
                                        <div class="dashboard-content-info">
                                            <h6>Rdv aujourd'hui</h6>
                                            <h4><?= isset($patientsToday) ? $patientsToday : 0 ?></h4>
                                        </div>
                                        <div class="dashboard-widget-icon">
                                            <span class="dash-icon-box"><i class="fa-solid fa-calendar-days"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 d-flex">
                                <div class="dashboard-card w-100">
                                    <div class="dashboard-card-head">
                                        <div class="header-title">
                                            <h5>Rendez-vous</h5>
                                        </div>
                                    </div>
                                    <div class="dashboard-card-body">
                                        <div class="table-responsive">
                                            <table class="table dashboard-table appoint-table">
                                                <tbody>
                                                    <?php if (isset($rdvs)): ?>
                                                        <?php foreach ($rdvs as $key => $rdv): ?>
                                                            <?php if ($rdv['etat'] !== 'annule'): ?>
                                                                <tr>
                                                                    <td>
                                                                        <div class="patient-info-profile">
                                                                            <a href="#" class="table-avatar">
                                                                                <img src="
                                                                                <?php
$patientId = $rdv['patient_id']; 
$patientModel = new \App\Models\PatientModel();
$patient = $patientModel->find($patientId); 

if ($patient): ?>
        <?= esc(base_url($patient['photo'])) ?>
<?php endif; ?>

                                                                                "
                                                                                    alt="Img">
                                                                            </a>
                                                                            <div class="patient-name-info">
                                                                                <h5>
                                                                                <?php
$patientId = $rdv['patient_id']; 
$patientModel = new \App\Models\PatientModel();
$patient = $patientModel->find($patientId); 

if ($patient): ?>
    <a href="#">
        <?= esc($patient['nom'] ?? '') ?>
        <?= esc($patient['prenom'] ?? '') ?>
    </a>
<?php else: ?>
    <a href="#">Patient inconnu</a>
<?php endif; ?>

                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="appointment-date-created">
                                                                            <h6><?= $rdv['jour'] ?? '' ?>
                                                                                <?= $rdv['horaire'] ?? '' ?>
                                                                            </h6>
                                                                            <span
                                                                                class="badge table-badge"><?= $rdv['motif'] ?? '' ?></span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="apponiment-actions d-flex align-items-center">
                                                                            <a href="#" class="text-success-icon me-2"
                                                                                data-rdv-id="<?= $rdv['id'] ?>"><i
                                                                                    class="fa-solid fa-check"></i></a>
                                                                            <a href="#" class="text-danger-icon"
                                                                                data-rdv-id="<?= $rdv['id'] ?>"><i
                                                                                    class="fa-solid fa-xmark"></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const xmarkIcons = document.querySelectorAll('.text-danger-icon');
            const checkIcons = document.querySelectorAll('.text-success-icon');

            xmarkIcons.forEach(icon => {
                icon.addEventListener('click', function (event) {
                    event.preventDefault();

                    if (confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?')) {
                        const rdvId = this.dataset.rdvId;

                        $.ajax({
                            url: '<?= base_url("rdv/cancel") ?>',
                            method: 'POST',
                            data: {
                                <?= csrf_token() ?>: '<?= csrf_hash() ?>',
                                rdv_id: rdvId
                            },
                            success: function (response) {
                                alert('Rendez-vous annulé avec succès');
                                location.reload();
                            },
                            error: function (xhr) {
                                alert('Une erreur est survenue lors de l\'annulation du rendez-vous');
                            }
                        });
                    }
                });
            });

            checkIcons.forEach(icon => {
                icon.addEventListener('click', function (event) {
                    event.preventDefault();

                    if (confirm('Êtes-vous sûr de vouloir accepter ce rendez-vous ?')) {
                        const rdvId = this.dataset.rdvId;

                        $.ajax({
                            url: '<?= base_url("rdv/accepte") ?>',
                            method: 'POST',
                            data: {
                                <?= csrf_token() ?>: '<?= csrf_hash() ?>',
                                rdv_id: rdvId
                            },
                            success: function (response) {
                                alert('Rendez-vous accepté avec succès');
                                location.reload();
                            },
                            error: function (xhr) {
                                alert('Une erreur est survenue lors de l\'acceptation du rendez-vous');
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>