<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/helpers/url_helper.php';

use App\Router;
use App\Controllers\AuthController;
use App\Controllers\ReservationController;

// Activer l'affichage des erreurs en développement
ini_set('display_errors', 1);
error_reporting(E_ALL);

$router = new Router();

/*
|--------------------------------------------------------------------------
| ROUTES AUTHENTIFICATION
|--------------------------------------------------------------------------
*/
$router->get('/', [AuthController::class, 'splash']);
$router->get('/splash', [AuthController::class, 'splash']);
$router->get('/login', [AuthController::class, 'loginForm']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'registerForm']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| ROUTES DASHBOARD
|--------------------------------------------------------------------------
*/
$router->get('/dashboard/admin', [AuthController::class, 'adminDashboard']);
$router->get('/dashboard/client', [AuthController::class, 'clientDashboard']);
/*
|--------------------------------------------------------------------------
| ROUTES RESERVATIONS
|--------------------------------------------------------------------------
*/
$router->get('/reservations', [ReservationController::class, 'index']);
$router->get('/reservations/create', [ReservationController::class, 'create']);
$router->post('/reservations/create', [ReservationController::class, 'create']);
$router->get('/reservations/edit/:id', [ReservationController::class, 'edit']);
$router->post('/reservations/edit/:id', [ReservationController::class, 'edit']);
$router->get('/reservations/delete/:id', [ReservationController::class, 'cancel']);

$router->dispatch();