<?php
namespace App;

class Router {
    private array $routes = [];

    public function get(string $path, array $action): void {
        $this->routes[] = ['method' => 'GET', 'path' => $path, 'controller' => $action[0], 'function' => $action[1]];
    }

    public function post(string $path, array $action): void {
        $this->routes[] = ['method' => 'POST', 'path' => $path, 'controller' => $action[0], 'function' => $action[1]];
    }

    public function dispatch(): void {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Nettoyage automatique du dossier parent (ex: /AJI_NL3BO_MANAGEMENT/)
        $baseDir = dirname($_SERVER['SCRIPT_NAME']); 
        if ($baseDir !== '/' && strpos($uri, $baseDir) === 0) {
            $uri = substr($uri, strlen($baseDir));
        }

        $uri = rtrim($uri, '/') ?: '/';

        foreach ($this->routes as $route) {
            // Gestion des paramètres dynamiques comme :id
            $pattern = preg_replace('#:([a-zA-Z0-9_]+)#', '([^/]+)', $route['path']);
            $pattern = '#^' . $pattern . '$#';

            if ($route['method'] === $method && preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // On enlève le premier match complet
                
                $controllerClass = $route['controller'];
                $methodName = $route['function'];

                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass();
                    $controller->$methodName(...$matches);
                    return;
                }
            }
        }
        $this->notFound();
    }

    private function notFound(): void {
        http_response_code(404);
        echo "<h1>404 - Page non trouvée</h1><p>Le router n'a pas trouvé la route demandée.</p>";
    }
}