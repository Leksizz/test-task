<?php

namespace App\Core\Session;

// Класс для работы с сессией пользователя
class Session
{
    public function __construct()
    {
        session_start();
    }

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function getColumn(string $key, string $column, $default = null): mixed
    {
        return $_SESSION[$key][$column];
    }


    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function destroy(): void
    {
        session_destroy();
    }
}