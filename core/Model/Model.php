<?php

namespace App\Core\Model;

use App\Core\DataBase\DataBase;

// Базовый класс модели

abstract class Model
{
    protected DataBase $db;

    public function __construct(DataBase $db)
    {
        $this->db = $db;
    }

    abstract protected function table(): string;
}