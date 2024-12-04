<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function () {
    return view('home');
});

//register form
$routes->get('/register-form', 'RegisterController::index');
//register 
$routes->post('/register', 'RegisterController::register');

$routes->post('patient/register', 'PatientController::register', ['as' => 'patientRegister']);



//login 
$routes->get('/loginForm', 'LoginController::index', ['as' => 'loginForm']);
//admin-login-succes
$routes->get('/admin-home', 'MedecinController::List',['as' => 'admin-home']);
//patient-login-succes
$routes->get('/patient-home', 'PatientController::index');
//medecin-login-succes
$routes->get('/medecin-home', 'MedecinController::index');
//secretaire-login-succes
$routes->get('/secretaire-home', 'SecretaireController::index');



$routes->post('/send-login-form', 'LoginController::login');
$routes->get('/logout', to: 'LoginController::logout');
$routes->post('/logout', to: 'LoginController::logout');
//create admin
$routes->get('/create-admin', 'AdminController::create');
//create patient
$routes->get('/create-patient', 'PatientController::create');
$routes->get('/medecin-form', 'MedecinController::form');
$routes->post('/create-medecin', 'MedecinController::create');
//create secretaire
$routes->get('/create-secretaire', 'SecretaireController::create');

//Patient routes
$routes->get('/patients', 'PatientController::list');
$routes->get('/patients/edit/(:num)', 'PatientController::edit/$1');
$routes->post('/patients/update/(:num)', 'PatientController::update/$1');
$routes->get('/patients/delete/(:num)', 'PatientController::delete/$1');

//Med routes
$routes->get('/medecins', 'MedecinController::list');
$routes->get('/medecin/edit/(:num)', 'MedecinController::edit/$1');
$routes->put('/medecin/update/(:num)', 'MedecinController::update/$1');
$routes->get('/medecin/delete/(:num)', 'MedecinController::delete/$1');


$routes->get('/create-medecein', 'MdedecinController::create');

//doctor
$routes->post('/search', 'DoctorSearchController::search', ['as' => 'doctorSearch']);
$routes->get('/doctor/(:num)', 'DoctorSearchController::show/$1');

//facebook register
$routes->get('auth/facebookRegister', 'AuthController::facebookRegister');
$routes->get('auth/facebookLogin', 'AuthController::facebookLogin');
$routes->get('auth/facebookCallback', 'AuthController::facebookCallback');


//patient pages
$routes->get('patient/dashboard', 'PatientController::appointment', ['as' => 'patient/dashboard']);
$routes->get('/patient-profile-settings', 'PatientController::settings', ['as', 'patient-profile-settings']);
$routes->post('/patient-profile-settings-update', 'PatientController::information');
$routes->get('patient/home', to: 'PatientController::index');


//parient password

$routes->get('/password', function () {
    return view('patient/password');
});
$routes->post('/password-update', 'PatientController::password');

$routes->get('/test', 'RdvController::test');


//prendre rdv
$routes->get('prendreRdv/(:num)', 'RdvController::prendreRdv/$1');


$routes->post('storeTime', 'RdvController::storeSelectedTime', ['as' => 'storeTime']);
$routes->get('rdvTelephone', 'RdvController::rdvTelephone', ['as' => 'rdvTelephone']);
$routes->get('rdv-telephone', function () {
    return view('rdv-telephone');
});
//send verification coed
$routes->post('sendCode', 'RdvController::sendCode', ['as' => 'sendCode']);
$routes->post('verifierCode', 'RdvController::verifierCode', ['as' => 'verifierCode']);
$routes->get('verification-code', function () {
    return view('code-confirmation');
}, ['as' => 'verification-code']);

//create rdv
$routes->get('rdvStore', 'RdvController::store', ['as' => 'rdvStore']);
//rdv
$routes->post('rdv/cancel', 'MedecinController::cancel', ['as' => 'rdv-cancel']);
$routes->post('rdv/accepte', 'MedecinController::accept', ['as' => 'rdv-accepte']);
//dashboard
$routes->get('dashboard', 'MedecinController::index', ['as' => 'dashboard']);
//rdvs
$routes->get('medecin-rdvs', 'MedecinController::rdvs', ['as' => 'rdvs']);

//doctor-password
$routes->get('/medecin-password', function () {
    return view('medecin/password');
}, ['as' => 'medecin-password']);
$routes->post('/medecin-password-update', 'MedecinController::password');
//cordonnes
$routes->get('/medecin-coordonnes', 'MedecinController::editCoordinates', ['as' => 'medecin-coordonnes']);
$routes->post('/medecin-coordonnes-update', 'MedecinController::saveCoordinates', ['as' => 'medecin-coordonnes-save']);
