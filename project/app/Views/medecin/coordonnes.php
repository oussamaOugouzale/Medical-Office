<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?= base_url('assets/img/preview-banner.jpg') ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="<?= base_url('assets/img/preview-banner.jpg') ?>">
    <title>Doccure - Doctor Profile</title>

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
                        <ul class="main-nav">
                        </ul>
                    </div>
                    <ul class="nav header-navbar-rht">
                        <li class="nav-item">
                            <a href="<?= base_url('/logout') ?>" class="nav-link">Se déconnecter</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="breadcrumb-bar-two">
            <div class="container">
                <div class="row align-items-center inner-banner">
                    <div class="col-md-12 col-12 text-center">
                        <h2 class="breadcrumb-title">Doctor Profile</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Doctor Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contentx Section -->
        <div class="content doctor-content">
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
                                        <h3><a href="#">Dr
                                                <?= esc(session()->get('doctor.nom') . ' ' . session()->get('doctor.prenom')) ?></a>
                                        </h3>
                                        <div class="patient-details">
                                            <h5 class="mb-0">ttttttttttttttest, somthinnnng</h5>
                                        </div>
                                        <?php
                                        $doctorId = session()->get('doctor.id'); 
                                        $specialitesModel = new \App\Models\SpecialiteModel(); 
                                        $specialite = $specialitesModel->where('doctor_id', $doctorId)->first(); 
                                        
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
                                        <li class="active">
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
                            <h3>Profile Settings</h3>
                        </div>

                        <div class="setting-tab">
                            <div class="appointment-tabs">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="">Informations
                                            personnelles</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active"
                                            href="<?= base_url('/profile-settings-coordonnes') ?>">Coordonnées</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="">Spécialités</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="">Photo du cabinet</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="">Horaires
                                            de travail</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <form action="<?= base_url('/medecin-coordonnes-update') ?>" method="POST">
                            <?= csrf_field() ?>

                            <?php if (session()->get('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= session()->get('success') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->get('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= session()->get('error') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <div class="setting-title">
                                <h5>COORDONNÉES</h5>
                            </div>

                            <div class="setting-card">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Adresse <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="adresse" class="form-control" required
                                                value="<?= esc($doctor['coordonnes']['adresse'] ?? '') ?>"
                                                placeholder="Rue, étage, centre ...">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Ville <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="ville" class="form-control" required
                                                value="<?= esc($doctor['coordonnes']['ville'] ?? '') ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Délégation <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="delegation" class="form-control" required
                                                value="<?= esc($doctor['coordonnes']['delegation'] ?? '') ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Téléphone fixe <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="tele_fixe" class="form-control" required
                                                value="<?= esc($doctor['coordonnes']['tele_fixe'] ?? '') ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Téléphone mobile <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="tele_mobile" class="form-control" required
                                                value="<?= esc($doctor['coordonnes']['tele_mobile'] ?? '') ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Latitude <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="latitude" class="form-control" id="latitude"
                                                readonly value="<?= esc($doctor['coordonnes']['latitude'] ?? '') ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Longitude <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="longitude" class="form-control" id="longitude"
                                                readonly value="<?= esc($doctor['coordonnes']['longitude'] ?? '') ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Géolocalisation <span
                                                    class="text-danger">*</span></label>
                                            <button type="button" class="btn btn-primary"
                                                onclick="getLocation()">Obtenir la géolocalisation</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-btn text-end">
                                <button type="submit" class="btn btn-primary prime-btn">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script>
        
        function previewImage(event) {
            const icon = document.getElementById('icon');
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function () {
                preview.src = reader.result;
                preview.style.display = 'block';
                icon.style.display = 'none';
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                icon.style.display = 'block';
            }
        }

        
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("La géolocalisation n'est pas prise en charge par ce navigateur.");
            }
        }

        
        function showPosition(position) {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
        }

        
        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("L'utilisateur a refusé la demande de géolocalisation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Les informations de position sont indisponibles.");
                    break;
                case error.TIMEOUT:
                    alert("La demande de géolocalisation a expiré.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("Une erreur inconnue s'est produite.");
                    break;
            }
        }
    </script>
</body>

</html>