<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\Concerns\HasCollectionPagination;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use HasCollectionPagination;

    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function accountRegister(array $data): void
    {
        $this->userRepository->create($data);
    }

    public function login(string $username, string $password): bool
    {

        $user = $this->userRepository->fetchData($username);

        if ($user && $user->checkPassword($password)) {

            $credentials = [
                'username' => $username,
                'password' => $password,
            ];

            if (Auth::attempt($credentials)) {
                return true;
            }
        }

        return false;
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
    }

    public function getUsers(bool $isPaginated = true): LengthAwarePaginator|Collection
    {
        return ($isPaginated == true)
            ? $this->paginate($this->userRepository->fetchAll())
            : $this->userRepository->fetchAll();
    }
}
