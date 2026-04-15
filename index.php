<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\ReservationController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

switch ($uri) {
    case '/reservations':
        (new ReservationController())->index();
        break;

    case '/reservations/create':
        (new ReservationController())->create();
        break;

    case (preg_match('#^/reservations/edit/(\d+)$#', $uri, $matches) ? true : false):
        (new ReservationController())->edit($matches[1]);
        break;

    case (preg_match('#^/reservations/delete/(\d+)$#', $uri, $matches) ? true : false):
        (new ReservationController())->delete($matches[1]);
        break;

    default:
        echo "404 - Page non trouvée";
        break;
}