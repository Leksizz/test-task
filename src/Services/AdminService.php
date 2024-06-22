<?php

namespace App\Src\Services;

use App\Core\DataBase\DataBase;
use App\Core\Http\Response\Response;
use App\Src\Models\Phone;
use App\Src\Models\User;
use App\Src\Models\UserPhone;
use JetBrains\PhpStorm\NoReturn;
use Random\RandomException;

class AdminService
{

    private User $user;

    private Phone $phone;

    private UserPhone $userPhone;
    private Response $response;

    public function __construct(DataBase $db, Response $response)
    {
        $this->user = new User($db);
        $this->phone = new Phone($db);
        $this->userPhone = new UserPhone($db);
        $this->response = $response;
    }

    /**
     * @throws RandomException
     */
    public function createUser(array $data): void
    {
        $this->isNewEmail($data['email']); // Проверка на уникальность имейла

        $pattern = '/^phone\d+$/'; // т.к. ключи в пост-запросе phone1, phone2, phone3
        $phones = [];

        foreach ($data as $key => $value) {
            if (preg_match($pattern, $key)) {
                $phones[] = $value;
                unset($data[$key]); // Удаляем телефоны из массива, чтобы добавить пользователя
            }
        }

        $data['password'] = password_hash(random_int('12345678', '987654321'), PASSWORD_BCRYPT);
        $user = $this->user->create($data);
        $phoneIds = $this->createPhone($phones);
        $this->createUserPhone($user, $phoneIds);
    }

    private function createPhone(array $phones): false|array
    {
        return $this->phone->create($phones);
    }

    private function createUserPhone(string $user, array $phoneIds): void
    {
        // Создание связанных данных, если пользователь добавил телефоны
        $data = ['user_id' => $user, 'phone_ids' => $phoneIds];
        if ($user && $phoneIds) {
            $this->userPhone->create($data);
        }
    }

    private function isNewEmail(string $email): void
    {
        if ($this->user->getByEmail($email)) {
            $this->response->json('error', 'Такой имейл уже занят');
        }
    }

    private function isCurrentEmail(int $id)
    {
        // Проверка, позволяющая редактировать пользователя, если он не меняет имейл
        return $this->user->find($id)['email'];
    }

    public function updateUser(array $data, int $id): void
    {
        if ($data['email'] !== $this->isCurrentEmail($id)) {
            $this->isNewEmail($data['email']);
        }
        $pattern = '/^phone\d+$/';
        $phones = [];
        $phoneIds = $this->userPhone->getPhonesIdsByUserId($id);
        foreach ($data as $key => $value) {
            if (preg_match($pattern, $key)) {
                $phones[] = $value;
                unset($data[$key]);
            }
        }

        $this->user->update($data, $id);

        if ($phoneIds === null) {
            $phoneIds = [];
        }

        // Блок для создания новых телефонов в случае, если уже существующему пользователю их добавляют
        if (count($phones) > count($phoneIds)) {
            for ($i = 0; $i < count($phoneIds); $i++) {
                unset($phones[$i]);
            }
            $this->createNewPhone($phones, $id);
        }

        $this->phone->update($phones, $phoneIds);
    }

    #[NoReturn] private function createNewPhone(array $phones, int $id): void
    {
        $phoneIds = $this->createPhone($phones);
        $this->createUserPhone($id, $phoneIds);
        $this->response->redirect('admin/index/1');
    }

    public function deleteUser(int $id): void
    {
        $phoneIds = $this->userPhone->getPhonesIdsByUserId($id);
        if ($phoneIds !== null) {
            $this->phone->delete($phoneIds);
        }
        $this->user->delete($id);
    }
}

