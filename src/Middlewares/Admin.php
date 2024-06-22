<?php

namespace App\Src\Middlewares;

use App\Core\Middleware\Middleware;

class Admin extends Middleware
{
    public function handle(): void
    {
        if (!$this->auth->admin()) {
            $this->redirect->to('/');
        }
    }
}