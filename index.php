<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';

define('BASE_URL', '/aji_nl3bo_managment');

use App\Router;
use App\Controllers\AuthController;
use App\Controllers\GameController;
use App\Controllers\CategoryController;
use App\Controllers\ReservationController;


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
| ROUTES GAMES
|--------------------------------------------------------------------------
*/
$router->get('/games', [GameController::class, 'index']);
$router->get('/games/create', [GameController::class, 'create']);
$router->post('/games/store', [GameController::class, 'store']);
$router->get('/games/show/:id', [GameController::class, 'show']);
$router->get('/games/edit/:id', [GameController::class, 'edit']);
$router->post('/games/update/:id', [GameController::class, 'update']);
$router->get('/games/destroy/:id', [GameController::class, 'destroy']);


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

/*
|--------------------------------------------------------------------------
| ROUTES CATEGORIES
|--------------------------------------------------------------------------
*/
$router->get('/categories', [CategoryController::class, 'index']);
$router->get('/categories/create', [CategoryController::class, 'create']);
$router->post('/categories/store', [CategoryController::class, 'store']);
$router->get('/categories/edit/:id', [CategoryController::class, 'edit']);
$router->post('/categories/update/:id', [CategoryController::class, 'update']);
$router->get('/categories/destroy/:id', [CategoryController::class, 'destroy']);

$router->dispatch();
