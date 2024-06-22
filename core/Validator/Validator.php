<?php

namespace App\Core\Validator;

// Класс валидации, который проверяет корректность введенных данных
class Validator
{
    private array $errors = [];

    public function validate(array $data): bool
    {
        foreach ($data as $key => $value) {

            $key = preg_replace('/^phone(?P<index>\d+)$/', 'phone', $key);

            $error = $this->validateRule($value, $key);

            if ($error) {
                $this->errors[] = $error;
            }
        }
        return empty($this->errors);
    }

    public function errors(): array|string
    {
        return $this->errors;
    }


    private function validateRule(mixed $value, string $key): string|false
    {
        $patterns = [
            'name' => "/^[a-zA-Z]+$/",
            'lastname' => "/[a-zA-Z]+$/",
            'email' => "/(\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6})/",
            'company' => "/^(?:[a-zA-Z]+|Нет)$/",
            'position' => "/^(?:[a-zA-Z]+|Нет)$/",
            'password' => '/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15})/',
            'phone' => '/^(8[0-9]{10}|Нет)$/'
        ];

        $errors = [
            'name' => "Поле имя может содержать только буквы латинского алфавита",
            'lastname' => "Поле фамилия может содержать только буквы латинского алфавита",
            'email' => "Поле имейл может содержать только буквы латинского алфавита",
            'company' => "Поле дата рождения должно содержать дату в формате Д:М:Г",
            'position' => "Логин может содержать только: буквы латинского алфавита, цифры и знаки
                    подчеркивания",
            'password' => "Пароль: от 8-15 символов, с минимум одной цифрой, одной заглавной и
                одной строчной буквой.",
            'phone' => "Неверный формат телефона"
        ];
        if (preg_match($patterns[$key], $value)) {
            return false;
        } else {
            return $errors[$key];
        }
    }
}