<?php

namespace App\Core\Controller;

use App\Core\Auth\Auth;
use App\Core\DataBase\DataBase;
use App\Core\Http\Redirect\Redirect;
use App\Core\Http\Request\Request;
use App\Core\Http\Response\Response;
use App\Core\Session\Session;
use App\Core\View\View;
use Exception;
use JetBrains\PhpStorm\NoReturn;

// Базовый класс Контроллера с необходимыми классами
abstract class Controller
{
    private View $view;
    private Request $request;
    private Session $session;
    private DataBase $dataBase;
    private Auth $auth;
    private Response $response;
    private Redirect $redirect;

    /**
     * @throws Exception
     */
    public function view(string $path, string $title): void
    {
        $this->view->render($path, $title);
    }

    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function request(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function setRedirect(Redirect $redirect): void
    {
        $this->redirect = $redirect;
    }

    #[NoReturn] public function redirect(string $url): void
    {
        $this->redirect->to($url);
    }

    public function setSession(Session $session): void
    {
        $this->session = $session;
    }

    public function session(): Session
    {
        return $this->session;
    }

    public function setDataBase(DataBase $dataBase): void
    {
        $this->dataBase = $dataBase;
    }

    public function db(): DataBase
    {
        return $this->dataBase;
    }

    public function setAuth(Auth $auth): void
    {
        $this->auth = $auth;
    }

    public function auth(): Auth
    {
        return $this->auth;
    }

    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }

    public function response(): Response
    {
        return $this->response;
    }
}
