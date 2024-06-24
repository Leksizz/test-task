<?php

namespace App\Src\Controllers;

use App\Core\Controller\Controller;
use App\Src\Services\AuthService;
use Exception;
use JetBrains\PhpStorm\NoReturn;

// Контроллер для работы с авторизацией

class AuthController extends Controller
{
    /**
     * @throws Exception
     */

    public function index(): void
    {
        $this->view('auth/index', 'Вход');
    }

    #[NoReturn] public function login(): void
    {
        $authService = new AuthService($this->db(), $this->session());

        if (!$this->request()->validate()) {
            $this->response()->json('error', $this->request()->errors());
        }

        if (!$authService->attempt($this->request()->all())) {
            $this->response()->json('error', 'Неверный логин или пароль');
        }

        $this->response()->redirect('admin/index/1');
    }

    #[NoReturn] public function logout(): void
    {
        $this->auth()->logout();
        $this->redirect('/');
    }
}