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
                        <a href="<?= base_url('index') ?>" class="navbar-brand logo">
                            <img src="" class="img-fluid" alt="Logo">
                        </a>
                    </div>
                    <div class="main-menu-wrapper">
                        <div class="menu-header">
                            <a href="<?= base_url('index') ?>" class="menu-logo">
                                <img src="<?= base_url('assets/img/logo-01.svg') ?>" class="img-fluid" alt="Logo">
                            </a>
                            <a id="menu_close" class="menu-close" href="javascript:void(0);">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <ul class="main-nav">
                            <li class="has-submenu megamenu active">
                                <a href="<?= base_url('home') ?>">Home </a>
                            </li>
                            <li class="has-submenu megamenu">
                                <a href="<?= base_url('contact') ?>">Contact </a>
                            </li>
                            <li class="has-submenu megamenu">
                                <a href="<?= base_url('about-us') ?>">Qui sommes-nous ?</a>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav header-navbar-rht">
                        <?php if (session()->has('patient_logged_in')): ?>
                            <li class="nav-item">
                                <a class="nav-link header-login" href="<?= route_to('pat-appointments') ?>"><img
                                        src="<?= base_url('assets/img/icons/user-circle.svg') ?>" alt="img">Mon Compte </a>
                            </li>
                        <?php elseif (session()->has('doctor_logged_in')): ?>
                            <li class="nav-item">
                                <a class="nav-link header-login" href="<?= route_to('dashboard') ?>"><img
                                        src="<?= base_url('assets/img/icons/user-circle.svg') ?>" alt="img">Dashboard </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link header-login" href="<?= route_to('loginForm') ?>"><img
                                        src="<?= base_url('assets/img/icons/user-circle.svg') ?>" alt="img">Connexion /
                                    Inscription </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </header>
        <section class="doctor-search-section"
            style="background-color: #f9f9f9; padding: 50px 0; position: relative; z-index: 10;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7" style="position: relative; z-index: 11;">
                        <div class="doctor-search">
                            <div class="banner-header">
                                <h2><span>Rechercher un Médecin,</span> Prendre un Rendez-vous</h2>
                                <p>Sélectionnez votre médecin, choisissez la date et l'heure de votre rdv et recevez
                                    votre sms de confirmation. C’est aussi simple que ça !</p>
                            </div>
                            <div class="doctor-form">
                                <?php if (session()->has('error')): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?= session('error') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <?php if (session()->has('notfound')): ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <?= session('notfound') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <form action="<?= route_to('doctorSearch') ?>" id="searchForm" method="POST"
                                    class="doctor-search">
                                    <?= csrf_field() ?>
                                    <div class="input-box-twelve">
                                        <div class="search-input input-block">
                                            <input type="text" name="localisation" class="form-control"
                                                placeholder="Localisation">
                                            <a class="current-loc-icon current_location" href="javascript:void(0);">
                                                <i class="fa-solid fa-location-crosshairs"></i>
                                            </a>
                                        </div>
                                        <div class="search-input input-block">
                                            <select class="select form-control" name="specialite">
                                                <option value="" selected>Sélectionnez votre spécialité</option>
                                                <option value="13">Cardiologue</option>
                                                <option value="24">Chirurgien Esthétique</option>
                                                <option value="20">Chirurgien Orthopédiste Traumatologue</option>
                                                <option value="29">Dentiste</option>
                                                <option value="30">Dermatologue</option>
                                                <option value="33">Endocrinologue Diabétologue</option>
                                                <option value="35">Gastro-entérologue</option>
                                                <option value="36">Généraliste</option>
                                                <option value="39">Gynécologue Obstétricien</option>
                                                <option value="49">Interniste</option>
                                                <option value="154">Laboratoire d'analyses de biologie médicale</option>
                                                <option value="62">Néphrologue</option>
                                                <option value="64">Neurologue</option>
                                                <option value="65">Nutritionniste</option>
                                                <option value="66">Ophtalmologiste</option>
                                                <option value="70">Oto-Rhino-Laryngologiste (ORL)</option>
                                                <option value="72">Pédiatre</option>
                                                <option value="78">Pneumologue</option>
                                                <option value="93">Psychiatre</option>
                                                <option value="94">Psychothérapeute</option>
                                                <option value="80">Radiologue</option>
                                                <option value="87">Rhumatologue</option>
                                                <option value="95">Sexologue</option>
                                                <option value="92">Urologue</option>
                                                <optgroup label="Autres spécialités">
                                                    <option value="111">Acupuncture</option>
                                                    <option value="120">Addictologue</option>
                                                    <option value="121">Algologue</option>
                                                    <option value="89">Allergologue</option>
                                                    <!-- Ajouter d'autres options si nécessaire -->
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="search-input input-block">
                                            <input type="text" class="form-control" name="nom" placeholder=" Médecin">
                                        </div>
                                        <div class="input-block">
                                            <div class="search-btn-info">
                                                <a href=""
                                                    onclick="event.preventDefault(); document.getElementById('searchForm').submit();">
                                                    <i class="fa-solid fa-magnifying-glass"></i>Search
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <img src="<?= base_url('assets/img/banner/doctor-banner.png') ?>" class="img-fluid dr-img"
                            alt="doctor-image">
                    </div>
                </div>
            </div>
        </section>

    </div>
    <script src="<?= base_url('assets/js/jquery-3.7.1.min.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/slick.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/moment.min.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/bootstrap-datetimepicker.min.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/plugins/select2/js/select2.min.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/backToTop.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/aos.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/owl.carousel.min.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/script.js') ?>" type="text/javascript"></script>

</body>

</html>