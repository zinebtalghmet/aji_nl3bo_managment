<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';

use App\Router;
use App\Controllers\AuthController;

$router = new Router();

// Routes d'authentification
$router->get('/',        [AuthController::class, 'splash']);
$router->get('/splash',  [AuthController::class, 'splash']);
$router->get('/login',   [AuthController::class, 'loginForm']);
$router->post('/login',  [AuthController::class, 'login']);
$router->get('/register',[AuthController::class, 'registerForm']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/logout', [AuthController::class, 'logout']);

// Routes Dashboard (À créer dans vos futurs Controllers)
// Remplacez les fonctions anonymes par des appels aux contrôleurs
$router->get('/dashboard/admin',  [App\Controllers\AuthController::class, 'adminDashboard']);
$router->get('/dashboard/client', [App\Controllers\AuthController::class, 'clientDashboard']);
$router->dispatch();