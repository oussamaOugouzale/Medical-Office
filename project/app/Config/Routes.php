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
$routes->get('/loginForm', 'LoginController::index', ['as'=>'loginForm']);
//admin-login-succes
$routes->get('/admin-home', 'AdminController::index');
//patient-login-succes
$routes->get('/patient-home', 'PatientController::index');
//medecin-login-succes
$routes->get('/medecin-home', 'MedecinController::index');
//secretaire-login-succes
$routes->get('/secretaire-home', 'SecretaireController::index');



$routes->post('/send-login-form', 'LoginController::login');
//create admin
$routes->get('/create-admin', 'AdminController::create');
//create patient
$routes->get('/create-patient', 'PatientController::create');
//create medecin
$routes->get('/create-medecein', 'MdedecinController::create');
//create secretaire
$routes->get('/create-secretaire', 'SecretaireController::create');

