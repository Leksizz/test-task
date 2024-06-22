<?php

namespace App\Src\Middlewares;

use App\Core\Middleware\Middleware;

class Auth extends Middleware
{

    public function handle(): void
    {
        if (!$this->auth->check()) {
            $this->redirect->to('/login');
        }
    }
}