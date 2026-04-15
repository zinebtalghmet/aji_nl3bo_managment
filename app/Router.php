<?php

namespace App;

class Router
{
    // ---- ATTRIBUTS ----
    private array  $routes = [];
    private string $basePath;

    // ---- CONSTRUCTEUR ----
    public function __construct(string $basePath = '')
    {
        $this->basePath = rtrim($basePath, '/');
    }

    // ---- AJOUTER UNE ROUTE GET ----
    public function get(string $path, array $action): void
    {
        $this->routes[] = [
            'method'     => 'GET',
            'path'       => $path,
            'controller' => $action[0],
            'function'   => $action[1],
        ];
    }

    // ---- AJOUTER UNE ROUTE POST ----
    public function post(string $path, array $action): void
    {
        $this->routes[] = [
            'method'     => 'POST',
            'path'       => $path,
            'controller' => $action[0],
            'function'   => $action[1],
        ];
    }

    // ---- DISPATCHER : trouver la bonne route et appeler le controller ----
    public function dispatch(): void
{
    $method = $_SERVER['REQUEST_METHOD'];
    $uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // ---- SUPPRIMER LE SOUS-DOSSIER XAMPP ----
    $basePath = '/aji_nl3bo_managment';
    if (str_starts_with($uri, $basePath)) {
        $uri = substr($uri, strlen($basePath));
    }

    // URI vide → "/"
    $uri = rtrim($uri, '/') ?: '/';

    // ---- DEBUG TEMPORAIRE ----
    // die("URI après basePath : " . $uri);

    foreach ($this->routes as $route) {

        $pattern = preg_replace('#:([a-zA-Z0-9_]+)#', '([^/]+)', $route['path']);
        $pattern = '#^' . $pattern . '$#';

        if ($route['method'] === $method && preg_match($pattern, $uri, $matches)) {
            array_shift($matches);
            $params = $matches;

            $controllerClass = $route['controller'];
            $methodName      = $route['function'];

            $controller = new $controllerClass();
            $controller->$methodName(...$params);
            return;
        }
    }

    $this->notFound();
}

    // ---- 404 ----
    private function notFound(): void
    {
        http_response_code(404);
        echo '
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>404 — Page introuvable</title>
            <link rel="stylesheet" href="/public/css/style.css">
        </head>
        <body style="display:flex;align-items:center;justify-content:center;height:100vh;flex-direction:column;gap:1rem;">
            <h1>404</h1>
            <p>Page introuvable</p>
            <a href="/splash">← Retour à l\'accueil</a>
        </body>
        </html>';
    }
}