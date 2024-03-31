<?php

namespace App\Services;

use App\Models\User;
use App\Models\Car;
use App\Repositories\UserRepository;
use App\Services\Concerns\HasCollectionPagination;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;


class UserService
{
    use HasCollectionPagination;

    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function register(array $data): void
    {
        $this->userRepository->create($data);
    }

    public function updateDetails(int $id, array $data): User
    {
        $user = $this->getUser($id);
        $this->userRepository->update($user, $data);
        $user = $user->refresh();

        return $user;
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

    public function getUser(int $id): User
    {
        return $this->userRepository->fetch($id);
    }

    public function getCars(string $userName, $perPage = 5): LengthAwarePaginator
    {
        $user = $this->userRepository->fetchByName($userName);

        if (!$user) {
            return new LengthAwarePaginator([], 0, $perPage);
        }

        $cars = Car::where('name', $user->name)->paginate($perPage);

        return $cars;
    }
}
