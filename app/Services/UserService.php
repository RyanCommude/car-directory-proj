<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
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
}
