<?php

namespace App\Core;

use App\Core\Container\Container;

// Класс для запуска приложения

class App
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function run(): void
    {
        $this->container
            ->router
            ->dispatch(
                $this->container->request->uri(),
                $this->container->request->method(),
            );
    }
}