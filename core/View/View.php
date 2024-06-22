<?php

namespace App\Core\View;

use Exception;
use JetBrains\PhpStorm\NoReturn;

// Класс для работы с представлениями

class View
{
    /**
     * @throws Exception
     */
    public function render(string $path, string $title): void
    {
        $path = APP_PATH . "/views/$path.html";

        if (!file_exists($path)) {
            throw new Exception("View $path not found");
        }

        $GLOBALS['content'] = file_get_contents("$path");
        $GLOBALS['title'] = $title;

        require_once APP_PATH . '/views/layout/layout.php';
    }

    #[NoReturn] public static function errorCode(string $code): void
    {
        http_response_code($code);
        require_once APP_PATH . "/views/errors/$code.html";
        exit();
    }
}
