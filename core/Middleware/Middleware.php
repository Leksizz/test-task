<?php

namespace App\Core\Middleware;

use App\Core\Auth\Auth;
use App\Core\Http\Redirect\Redirect;
use App\Core\Http\Request\Request;

// Базовый мидлвар для перенаправления пользователя

abstract class Middleware
{
    public function __construct(
        protected Request  $request,
        protected Auth     $auth,
        protected Redirect $redirect,
    )
    {
    }

    abstract public function handle(): void;
}
