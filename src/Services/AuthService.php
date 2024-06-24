<?php

namespace App\Src\Services;

use App\Core\DataBase\DataBase;
use App\Core\Session\Session;
use App\Src\Models\User;

class AuthService
{

    private User $user;

    private Session $session;


    public function __construct(DataBase $db, Session $session)
    {
        $this->user = new User($db);
        $this->session = $session;
    }

    public function attempt(array $data): bool
    {
        $user = $this->user->getByEmail($data['email']);

        if (!$user) {
            return false;
        }

        if (!password_verify($data['password'], $user['password'])) {
            return false;
        }

        $this->session->set('user', $user);

        return true;
    }
}