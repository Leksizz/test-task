<?php

namespace App\Src\Models;

use App\Core\Model\Model;

class Phone extends Model
{
    // Получая в аргументе массив телефон, метод добавляет в таблицу новые номера, если они не равны "Нет"
    public function create(array $phones): false|array
    {
        $phoneIds = [];
        foreach ($phones as $phone) {
            if ($phone !== 'Нет') {
                $phoneIds[] = $this->db->insert([
                    'table' => $this->table(),
                    'data' => ['number' => $phone]
                ]);
            }
        }
        return $phoneIds;
    }

    public function getPhones(int $id): ?array
    {
        return $this->db->select([
            'table' => $this->table(),
            'where' => ['id' => $id]
        ]);
    }

    // Метод для обновления телефона по его id
    public function update(array $numbers, array $phoneIds): void
    {
        foreach ($numbers as $index => $number) {
            $id = $phoneIds[$index];

            if ($number != 'Нет') {
                $this->db->update([
                    'table' => $this->table(),
                    'set' => ['number' => $number],
                    'where' => ['id' => $id],
                ]);
            }
        }
    }

    // Метод для удаления телефона по его id
    public function delete(array $phoneIds): void
    {
        foreach ($phoneIds as $phoneId) {
            $this->db->delete([
                'table' => $this->table(),
                'where' => ['id' => $phoneId],
            ]);
        }
    }

    protected function table(): string
    {
        return 'phones';
    }
}