<?php

namespace App\Src\Controllers;

use App\Core\Controller\Controller;
use App\Src\Services\AdminService;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use Random\RandomException;

// Основной контроллер для работы в админской части

class AdminController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->view('admin/index', 'Пользователи');
    }

    /**
     * @throws Exception
     */
    public function create(): void
    {
        $this->view('admin/create', 'Добавление пользователя');
    }

    /**
     * @throws RandomException
     */
    #[NoReturn] public function store(): void
    {
        if (!$this->request()->validate()) {
            $this->response()->json('error', $this->request()->errors());
        }
        $this->service()->createUser($this->request()->all());
        $this->response()->redirect('admin/index/1');
    }

    /**
     * @throws Exception
     */
    public function edit(): void
    {
        $this->view('admin/edit', 'Редактирование пользователя');
    }

    #[NoReturn] public function update(): void
    {
        if (!$this->request()->validate()) {
            $this->response()->json('error', $this->request()->errors());
        }
        $this->service()->updateUser($this->request()->all(), $this->id());
        $this->response()->redirect('admin/index/1');
    }

    #[NoReturn] public function delete(): void
    {
        $this->service()->deleteUser($this->id());
        $this->redirect('/admin/index/1');
    }

    public function service(): AdminService
    {
        return new AdminService($this->db(), $this->response());
    }

    private function id(): int
    {
        return explode('/', $this->request()->uri())[3];
    }
}