<?php

namespace App\Core\Router;


use App\Core\Auth\Auth;
use App\Core\DataBase\DataBase;
use App\Core\Http\Redirect\Redirect;
use App\Core\Http\Request\Request;
use App\Core\Http\Response\Response;
use App\Core\Session\Session;
use App\Core\View\View;
use JetBrains\PhpStorm\NoReturn;

// Класс маршрутизатор для обработки полученных маршрутов

class Router
{
    public function __construct(
        private readonly View     $view,
        private readonly Request  $request,
        private readonly Redirect $redirect,
        private readonly Session  $session,
        private readonly DataBase $dataBase,
        private readonly Auth     $auth,
        private readonly Response $response,
    )
    {
        $this->initRoutes();
    }

    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);
        if (!$route) {
            $this->notFound();
        }

        if ($route->hasMiddlewares()) {
            foreach ($route->getMiddlewares() as $middleware) {
                $middleware = new $middleware($this->request, $this->auth, $this->redirect);
                $middleware->handle();
            }
        }

        if (is_array($route->getAction())) {

            [$controller, $action] = $route->getAction();

            $controller = new $controller();

            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, 'setAuth'], $this->auth);
            call_user_func([$controller, 'setDataBase'], $this->dataBase);
            call_user_func([$controller, 'setResponse'], $this->response);
            call_user_func([$controller, $action]);
        } else {
            call_user_func($route->getAction());
        }
    }

    private function findRoute(string $uri, string $method): Route|false
    {
        foreach ($this->routes[$method] as $pattern => $route) {
            if (preg_match("#^$pattern$#", $uri)) {
                return $route;
            }
        }
        return false;
    }

    private function initRoutes(): void
    {
        $routes = $this->getRoutes();
        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    private function getRoutes(): array
    {
        return require_once APP_PATH . '/routes/routes.php';
    }

    #[NoReturn] private function notFound(): void
    {
        View::errorCode('404');
    }
}
