<?php

namespace App\Core\Auth;

use App\Core\Session\Session;

readonly class Auth
{
    // Класс для работы с авторизацией
    public function __construct(
        private Session $session,
    )
    {
    }

    public function logout(): void
    {
        $this->session->remove('user');
    }

    public function check(): bool
    {
        return $this->session->has('user');
    }

    public function id()
    {
        return $this->session->getColumn('user', 'id');
    }

    public function admin(): bool
    {
        if ($this->session->getColumn('user', 'role') === 'admin') {
            return true;
        }
        return false;
    }
}