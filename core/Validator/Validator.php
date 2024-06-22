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
            'name' => "Поле имя может содержать только буквы",
            'lastname' => "Поле фамилия может содержать только буквы",
            'email' => "Неверный формат электронной почты",
            'company' => "Поле компания может содержать только буквы",
            'position' => "Поле должность может содержать только буквы",
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