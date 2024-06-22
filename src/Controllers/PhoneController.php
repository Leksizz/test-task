<?php

namespace App\Src\Controllers;

use App\Core\Controller\Controller;
use App\Src\Services\PhoneService;
use JetBrains\PhpStorm\NoReturn;

// Контроллер для работы с телефонами

class PhoneController extends Controller
{
    #[NoReturn] public function phones(): void
    {
        $phoneService = new PhoneService($this->db(), $this->response());
        $id = explode('/', $this->request()->uri())[2];
        $phones = $phoneService->getPhones($id);
        $this->response()->json('success', $phones);
    }
}