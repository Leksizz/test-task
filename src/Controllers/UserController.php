<?php

namespace App\Src\Controllers;

use App\Core\Controller\Controller;
use App\Src\Services\UserService;
use JetBrains\PhpStorm\NoReturn;

// Контроллер для работы с пользователями

class UserController extends Controller
{
    #[NoReturn] public function users(): void
    {
        $page = explode('/', $this->request()->uri())[3];
        $users = $this->service()->getUsers($page);
        $this->response()->json('success', $users);
    }

    #[NoReturn] public function user(): void
    {
        $id = explode('/', $this->request()->uri())[2];
        $user = $this->service()->getUser($id);
        $this->response()->json('success', $user);
    }

    public function service(): UserService
    {
        return new UserService($this->db());
    }
}