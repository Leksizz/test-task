<?php

namespace App\Src\Controllers;

use App\Core\Controller\Controller;
use Exception;

class MainController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->view('welcome', 'Тестовое задание');
    }
}