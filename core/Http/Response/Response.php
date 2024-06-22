<?php

namespace App\Core\Http\Response;

use JetBrains\PhpStorm\NoReturn;

// Класс для отправки json-ответов

class Response
{
    #[NoReturn] public function json(string $status, string|array $message): void
    {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    #[NoReturn] public function redirect(string $href): void
    {
        exit(json_encode(['href' => $href]));
    }
}