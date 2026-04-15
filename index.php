<?php

// ---- DEMARRER LA SESSION ----
session_start();

// ---- AUTOLOADING COMPOSER ----
require_once __DIR__ . '/vendor/autoload.php';

// ---- IMPORTS ----
use App\Router;
use App\Controllers\AuthController;

// ---- CREER LE ROUTER ----
$router = new Router();

// ================================================================
// ROUTES AUTH
// ================================================================
$router->get('/splash',    [AuthController::class, 'splash']);
$router->get('/login',     [AuthController::class, 'loginForm']);
$router->post('/login',    [AuthController::class, 'login']);
$router->get('/register',  [AuthController::class, 'registerForm']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/logout',    [AuthController::class, 'logout']);

// ================================================================
// ROUTES GAMES (à décommenter quand GameController sera prêt)
// ================================================================
// use App\Controllers\GameController;
// $router->get('/games',            [GameController::class, 'index']);
// $router->get('/games/:id',        [GameController::class, 'show']);
// $router->get('/games/create',     [GameController::class, 'create']);
// $router->post('/games',           [GameController::class, 'store']);
// $router->get('/games/:id/edit',   [GameController::class, 'edit']);
// $router->post('/games/:id/update',[GameController::class, 'update']);
// $router->post('/games/:id/delete',[GameController::class, 'destroy']);

// ================================================================
// ROUTES RESERVATIONS (à décommenter quand prêt)
// ================================================================
// use App\Controllers\ReservationController;
// $router->get('/reservations',              [ReservationController::class, 'index']);
// $router->get('/reservations/create',       [ReservationController::class, 'create']);
// $router->post('/reservations',             [ReservationController::class, 'store']);
// $router->get('/admin/reservations',        [ReservationController::class, 'adminIndex']);
// $router->post('/admin/reservations/:id/status', [ReservationController::class, 'updateStatus']);

// ================================================================
// ROUTES SESSIONS (à décommenter quand prêt)
// ================================================================
// use App\Controllers\SessionController;
// $router->post('/admin/sessions',        [SessionController::class, 'store']);
// $router->get('/admin/sessions',         [SessionController::class, 'dashboard']);
// $router->post('/admin/sessions/:id/end',[SessionController::class, 'end']);
// $router->get('/admin/sessions/history', [SessionController::class, 'history']);

// ================================================================
// DISPATCHER — lancer le routing
// ================================================================
$router->dispatch();