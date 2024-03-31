<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function fetchData(string $username): ?User
    {
        return User::where('username', $username)->first();
    }

    public function fetchAll(): Collection
    {
        return User::all();
    }

    public function fetch(int $id): User
    {
        return User::findOrFail($id);
    }

    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }

    public function fetchByName(string $name): ?User
    {
        return User::where('name', $name)->first();
    }
}
