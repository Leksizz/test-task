<?php

namespace App\Src\Services;

use App\Core\DataBase\DataBase;
use App\Core\Http\Response\Response;
use App\Src\Models\Phone;
use App\Src\Models\UserPhone;

class PhoneService
{

    private Phone $phone;
    private UserPhone $userPhone;
    private Response $response;

    public function __construct(DataBase $db, Response $response)
    {
        $this->phone = new Phone($db);
        $this->userPhone = new UserPhone($db);
        $this->response = $response;
    }

    // Получение телефонов по id пользователя
    public function getPhones(int $id): array
    {
        $phoneIds = $this->userPhone->getPhonesIdsByUserId($id);

        // В случае отсутствия у него телефонов
        if (!$phoneIds) {
            $this->response->json('success', 'Нет');
        }
        $phones = [];
        foreach ($phoneIds as $phoneId) {
            $phones[] = $this->phone->getPhones($phoneId);
        }
        return $phones;
    }
}