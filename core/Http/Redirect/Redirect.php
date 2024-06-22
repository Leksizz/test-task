<?php

namespace App\Core\Http\Redirect;

use JetBrains\PhpStorm\NoReturn;
// Класс для редиректов
class Redirect
{
    #[NoReturn] public function to(string $url): void
    {
        header("Location: $url");
        exit();
    }
}
