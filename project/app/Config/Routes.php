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
$routes->get('/admin-home', 'AdminController::index');
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
//create medecin
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
