<?php

namespace App\Core\Container;

use App\Core\Auth\Auth;
use App\Core\DataBase\DataBase;
use App\Core\Http\Redirect\Redirect;
use App\Core\Http\Request\Request;
use App\Core\Http\Response\Response;
use App\Core\Router\Router;
use App\Core\Session\Session;
use App\Core\Validator\Validator;
use App\Core\View\View;

// Сервис-контейнер для внедрения в контроллеры основных классов
readonly class Container
{
    public Request $request;
    public Router $router;
    public View $view;
    public Redirect $redirect;
    public Session $session;
    public DataBase $dataBase;
    public Validator $validator;
    public Auth $auth;
    public Response $response;

    public function __construct()
    {
        $this->registerServices();
    }

    private function registerServices(): void
    {
        $this->validator = new Validator();
        $this->request = Request::createFromGlobals();
        $this->request->setValidator($this->validator);
        $this->response = new Response();
        $this->redirect = new Redirect();
        $this->view = new View();
        $this->session = new Session();
        $this->dataBase = new DataBase();
        $this->auth = new Auth($this->session);
        $this->router = new Router($this->view, $this->request, $this->redirect, $this->session, $this->dataBase, $this->auth, $this->response);
    }
}
