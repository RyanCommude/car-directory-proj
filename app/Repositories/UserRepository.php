<?php

namespace App\Repositories;

use App\Models\User;

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
}
