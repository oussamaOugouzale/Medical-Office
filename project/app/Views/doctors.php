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
                            <li class="has-submenu megamenu active">
                                <a href="<?= base_url('/') ?>">Home</a>
                            </li>
                            <li class="has-submenu megamenu">
                                <a href="<?= base_url('/contact') ?>">Contact</a>
                            </li>
                            <li class="has-submenu megamenu">
                                <a href="<?= base_url('/about') ?>">Qui sommes-nous ?</a>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav header-navbar-rht">
                        <?php if (session()->has('patient')): ?>
                            <li class="nav-item">
                                <a class="nav-link header-login" href="<?= base_url('/pat-appointments') ?>">
                                    <img src="<?= base_url('assets/img/icons/user-circle.svg') ?>" alt="img"> Mon Compte
                                </a>
                            </li>
                        <?php elseif (session()->has('doctor')): ?>
                            <li class="nav-item">
                                <a class="nav-link header-login" href="<?= base_url('/dashboard') ?>">
                                    <img src="<?= base_url('assets/img/icons/user-circle.svg') ?>" alt="img"> Dashboard
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a href="<?= base_url('logout') ?>">Se déconnecter</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="breadcrumb-bar-two">
            <div class="container">
                <div class="row align-items-center inner-banner">
                    <div class="col-md-12 col-12 text-center">
                        <h2 class="breadcrumb-title">Search</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Search</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="col-md-12 col-lg-8 col-xl-9 mx-auto">
                    <?php if (isset($doctors) && !empty($doctors)): ?>
                        <?php foreach ($doctors as $doctor): ?>
                            <?php
                            // Vérification des coordonnées pour ce médecin dans la table "coordonne"
                            $coordonneesModel = new \App\Models\CoordonneModel();
                            $coordonnes = $coordonneesModel->where('doctor_id', $doctor['id'])->first();
                            ?>
                            <?php if ($coordonnes): ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="doctor-widget">
                                            <div class="doc-info-left">
                                                <div class="doctor-img">
                                                    <a href="<?= base_url('doctor-profile/' . $doctor['id']) ?>">
                                                        <img src="<?= esc('uploads/doctor.jpg') ?>" class="img-fluid"
                                                            alt="User Image">
                                                    </a>
                                                </div>
                                                <div class="doc-info-cont">
                                                    <h4 class="doc-name">
                                                        <a
                                                            href="#"><?= 'Dr. ' . esc($doctor['nom']) . ' ' . esc($doctor['prenom']) ?></a>
                                                    </h4>
                                                    <p class="doc-speciality">
                                                        <?php
                                                        $doctorId = $doctor['id'];
                                                        $specialitesModel = new \App\Models\SpecialiteModel();
                                                        $specialite = $specialitesModel->where('doctor_id', $doctorId)->first();

                                                        if ($specialite) {
                                                            echo esc($specialite['specialite']);
                                                            if (!empty($specialite['autre_specialite'])) {
                                                                echo " / " . esc($specialite['autre_specialite']);
                                                            }
                                                        } else {
                                                            echo "Aucune spécialité disponible.";
                                                        }
                                                        ?>
                                                    </p>


                                                    <div class="clinic-details">
                                                        <p class="doc-location">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                            <?= esc($coordonnes['adresse']) ?>
                                                        </p>
                                                        <ul class="clinic-gallery">
                                                            <?php $test = 23; // if (!empty($doctor['cabinets'])): ?>
                                                            <?php //foreach ($doctor['cabinets'] as $photo): ?>
                                                            <!-- <li>
                                                                        <a href="" data-fancybox="gallery">
                                                                            <img src="" alt="Feature">
                                                                        </a>
                                                                    </li> -->
                                                            <?php //endforeach; ?>
                                                            <?php //endif; ?>
                                                            <li>
                                                                <a href="<?= esc('uploads/cabinet1.jpg') ?>"
                                                                    data-fancybox="gallery">
                                                                    <img src="<?= esc('uploads/cabinet1.jpg') ?>" alt="Feature">
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="<?= esc('uploads/cabinet2.jpg') ?>"
                                                                    data-fancybox="gallery">
                                                                    <img src="<?= esc('uploads/cabinet2.jpg') ?>" alt="Feature">
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="<?= esc('uploads/cabinet3.jpg') ?>"
                                                                    data-fancybox="gallery">
                                                                    <img src="<?= esc('uploads/cabinet3.jpg') ?>" alt="Feature">
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="<?= esc('uploads/cabinet4.jpg') ?>"
                                                                    data-fancybox="gallery">
                                                                    <img src="<?= esc('uploads/cabinet4.jpg') ?>" alt="Feature">
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="clinic-services">
                                                        <span>Dental Fillings</span>
                                                        <span>Whitening</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="doc-info-right">
                                                <div class="clini-infos">
                                                    <ul>
                                                        <li>
                                                            <i class="fas fa-map-marker-alt"></i>
                                                            <?php
                                                            $doctorId = $doctor['id']; // Supposons que vous avez l'ID du docteur
                                                            $coordonneesModel = new \App\Models\CoordonneModel();
                                                            $coordonnes = $coordonneesModel->where('doctor_id', $doctorId)->first();
                                                            if ($coordonnes) {
                                                                echo esc($coordonnes['ville']);
                                                            } else {
                                                                echo "Ville non disponible";
                                                            }
                                                            ?>, MAROC
                                                        </li>
                                                        <li>
                                                            <i class="far fa-money-bill-alt"></i> 300DH - 1000DH
                                                            <i class="fas fa-info-circle" data-bs-toggle="tooltip"
                                                                title="Lorem Ipsum"></i>
                                                        </li>
                                                        <li>
                                                            <i class="fas fa-phone"></i>
                                                            <?php
                                                            if ($coordonnes) {
                                                                echo esc($coordonnes['tele_mobile']);
                                                            } else {
                                                                echo "Téléphone mobile non disponible";
                                                            }
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <i class="fas fa-phone-alt"></i>
                                                            <?php
                                                            if ($coordonnes) {
                                                                echo esc($coordonnes['tele_fixe']);
                                                            } else {
                                                                echo "Téléphone fixe non disponible";
                                                            }
                                                            ?>
                                                        </li>
                                                    </ul>

                                                </div>
                                                <div class="clinic-booking">
                                                    <a class="view-pro-btn" href="">Voir le profile</a>
                                                    <a class="apt-btn" href="<?= base_url('prendreRdv/' . $doctor['id']) ?>">Prendre
                                                        RDV</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Aucun docteur trouvé.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/jquery-3.7.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/slick.js') ?>"></script>
    <script src="<?= base_url('assets/js/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-datetimepicker.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/select2/js/select2.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/backToTop.js') ?>"></script>
    <script src="<?= base_url('assets/js/aos.js') ?>"></script>
    <script src="<?= base_url('assets/js/owl.carousel.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <script src="<?= base_url('assets/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') ?>"
        data-cf-settings="7073d074eb0ac309415a3550-|49" defer></script>
</body>

</html>