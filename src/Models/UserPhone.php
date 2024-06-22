<?php

namespace App\Src\Models;

use App\Core\Model\Model;

class UserPhone extends Model
{
    // Метод для создания связанных данных в таблице user_phone
    public function create(array $data): void
    {
        $userPhone['user_id'] = $data['user_id'];
        foreach ($data['phone_ids'] as $phone_id) {
            $userPhone['phone_id'] = $phone_id;
            $this->db->insert([
                'table' => $this->table(),
                'data' => $userPhone
            ]);
        }
    }

    // Метод для получения связанных телефон по id пользователя
    public function getPhonesIdsByUserId(int $id): ?array
    {
        $phoneIds = [];
        $userPhone = $this->db->select([
            'table' => $this->table(),
            'where' => ['user_id' => $id]
        ]);
        if ($userPhone) {
            foreach ($userPhone as $phones) {
                $phoneIds[] = $phones['phone_id'];
            }
        }
        return $phoneIds;
    }

    protected function table(): string
    {
        return 'user_phone';
    }
}