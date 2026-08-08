<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    public function getAllUsers(array $filters = []): LengthAwarePaginator
    {
        return $this->userRepository->getAll($filters);
    }

    public function getUserById(int $id): User
    {
        return $this->userRepository->findById($id);
    }

    public function createUser(array $data): User
    {
        return $this->userRepository->addUser($data);
    }

    public function updateUser(User $user, array $data): User
    {
        return $this->userRepository->updateUser($user, $data);
    }

    public function deleteUser(User $user): void
    {
        $this->userRepository->deleteUser($user);
    }
}