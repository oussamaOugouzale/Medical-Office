<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Doccure</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
        .timing {
            display: inline-block;
            margin: 5px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            color: #333;
            background-color: #f8f9fa;
        }

        .timing:hover {
            background-color: #f0f0f0 !important;
        }

        .timing.unselected {
            background-color: #ffcccc !important;
            color: #a00 !important;
            cursor: not-allowed;
        }

        .timing.reserved {
            background-color: #ffdddd !important;
            color: #a00 !important;
            cursor: not-allowed;
        }

        .timing.selected {
            background-color: #66cc66 !important;
            color: #fff !important;
        }
    </style>
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
                        <a href="<?= base_url() ?>" class="navbar-brand logo">
                            <img src="<?= base_url('assets/img/logo.png') ?>" class="img-fluid" alt="Logo">
                        </a>
                    </div>
                    <div class="main-menu-wrapper">
                        <ul class="main-nav">
                            <li class="has-submenu megamenu active"><a href="<?= base_url() ?>">Home</a></li>
                            <li class="has-submenu megamenu"><a href="<?= base_url('contact') ?>">Contact</a></li>
                            <li class="has-submenu megamenu"><a href="<?= base_url('about') ?>">Qui sommes-nous ?</a>
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

        <div class="content">
            <div class="container">
                <?php if (isset($doctor)): ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="booking-doc-info">
                                        <a href="#" class="booking-doc-img">
                                            <img src="<? esc('uploads/doctor.jpg') ?>" alt="User Image">
                                        </a>
                                        <div class="booking-info">
                                            <h4>Dr. <?= $doctor['nom'] . ' ' . $doctor['prenom'] ?></h4>
                                            <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i>
                                                <?php
                                                $doctorId = $doctor['id'];
                                                $coordonneesModel = new \App\Models\CoordonneModel();
                                                $coordonnes = $coordonneesModel->where('doctor_id', $doctorId)->first();
                                                if ($coordonnes) {
                                                    echo esc($coordonnes['ville']);
                                                } else {
                                                    echo "Ville non disponible";
                                                }
                                                ?>, Maroc
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-4 col-md-6">
                                    <h4 class="mb-1"><?= date('d F Y') ?></h4>
                                    <p class="text-muted"><?= date('l') ?></p>
                                </div>
                            </div>

                            <div class="card booking-schedule schedule-widget">
                                <div class="schedule-header">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="day-slot">
                                                <ul class="d-flex justify-content-around">
                                                    <?php foreach ($jours as $jour): ?>
                                                        <li>
                                                            <span><?= $jour->toLocalizedString('EEEE') ?></span>
                                                            <span
                                                                class="slot-date"><?= $jour->toLocalizedString('dd MMMM yyyy') ?></span>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="schedule-cont">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="time-slot">
                                                <ul class="d-flex justify-content-around">
                                                    <?php foreach ($jours as $jour): ?>
                                                        <li class="day-slot w-full">
                                                            <div class="time-slots w-full">
                                                                <?php
                                                                $date = $jour->toDateString();
                                                                if (isset($horaires_par_jour[$date])):
                                                                    foreach ($horaires_par_jour[$date] as $horaire): ?>
                                                                        <a class="timing <?= $horaire['reserved'] ? 'reserved' : '' ?> 
                                    w-full text-center py-2 rounded-lg border" href="javascript:;"
                                                                            data-date="<?= $horaire['date'] ?>">
                                                                            <span><?= $horaire['time'] ?></span>
                                                                        </a>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="submit-section proceed-btn text-end">
                                <a href="<?= base_url('storeTime') ?>" class="btn btn-primary submit-btn">Confirmer</a>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>

        <script src="<?= base_url('assets/js/jquery-3.7.1.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
        <script>
            $(document).ready(function () {
                // Gestion de la sélection d'un horaire
                $('.timing').on('click', function () {
                    if (!$(this).hasClass('reserved') && !$(this).hasClass('unselected')) {
                        $('.timing').removeClass('selected');
                        $(this).addClass('selected');
                    }
                });

                // Gestion du clic sur le bouton "Confirmer"
                $('.submit-btn').on('click', function (e) {
                    e.preventDefault(); // Empêche la redirection immédiate via le href

                    // Récupération des données sélectionnées
                    var selectedTime = $('.timing.selected').text().trim();
                    var selectedDate = $('.timing.selected').data('date');
                    var doctorId = "<?= $doctor['id'] ?>"; // Inclure le doctor_id dans votre vue PHP

                    if (selectedTime && selectedDate) {
                        // Envoi des données au backend
                        $.post("<?= base_url('storeTime') ?>", {
                            time: selectedTime,
                            date: selectedDate,
                            doctor_id: doctorId,
                            csrf_test_name: "<?= csrf_hash() ?>"
                        }, function (response) {
                            console.log(response.message);
                            // Redirection après succès
                            window.location.href = "<?= base_url('rdv-telephone') ?>";
                        }).fail(function (xhr) {
                            console.log(xhr.responseText); // Afficher les erreurs en cas d'échec
                        });
                    } else {
                        alert("Veuillez sélectionner un horaire avant de confirmer.");
                    }
                });
            });
        </script>

    </div>
</body>

</html>