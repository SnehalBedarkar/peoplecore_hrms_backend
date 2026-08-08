<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository
{
    public function getAll(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        return User::query()
            ->select('id', 'name', 'email', 'status', 'last_login_at')
            ->with('roles:id,name')
            ->whereDoesntHave('roles', fn ($q) => $q->where('name', 'SuperAdmin'))
            ->when($filters['search'] ?? null, fn ($q, $search) => $q->where(fn ($q) => $q
                ->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
            ))
            ->when($filters['role'] ?? null, fn ($q, $role) => $q->whereHas(
                'roles',
                fn ($q) => $q->where('name', $role)
            ))
            ->when($filters['status'] ?? null, fn ($q, $status) => $q->where('status', $status))
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    public function findById(int $id): User
{
    return User::query()
        ->select('id', 'name', 'email', 'phone', 'status')
        ->with('roles:id,name')
        ->whereDoesntHave('roles', fn ($q) => $q->where('name', 'SuperAdmin'))
        ->findOrFail($id);
}

    public function addUser(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'status' => $data['status'],
            'password' => $data['password'],
        ]);

        $user->roles()->sync($data['role_ids']);

        return $user;
    }

    public function updateUser(User $user, array $data): User
    {
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'status' => $data['status'],
            ...(! empty($data['password']) ? ['password' => $data['password']] : []),
        ]);

        $user->roles()->sync($data['role_ids']);

        return $user;
    }

    public function deleteUser(User $user): void
    {
        $user->roles()->detach();
        $user->delete();
    }
}
