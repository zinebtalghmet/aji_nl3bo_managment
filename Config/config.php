<?php

// SESSION (toujours en premier)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
|--------------------------------------------------------------------------
| BASE URL
|--------------------------------------------------------------------------
*/

$isHttps = (!empty($_SERVER['HTTPS'] ?? '') && $_SERVER['HTTPS'] !== 'off')
    || (($_SERVER['SERVER_PORT'] ?? 80) == 443);

$protocol = $isHttps ? "https://" : "http://";

$host = $_SERVER['HTTP_HOST'] ?? 'localhost';

$scriptName = $_SERVER['SCRIPT_NAME'] ?? '/';

$basePath = rtrim(dirname($scriptName), '/\\');

define('BASE_URL', $protocol . $host . $basePath);

/*
|--------------------------------------------------------------------------
| PATHS
|--------------------------------------------------------------------------
*/
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('VIEW_PATH', APP_PATH . '/Views');
define('PUBLIC_PATH', ROOT_PATH . '/public');