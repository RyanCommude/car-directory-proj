<?php

namespace App\Livewire;

use App\Services\UserService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination, WithoutUrlPagination;

    private $service;

    public $readyToLoad = false;

    public function boot(UserService $service)
    {
        $this->service = $service;
    }

    public function logout()
    {
        $this->service->logout();
        return $this->redirectRoute('user.login');
    }

    public function createRoute()
    {
        return redirect()->route('user-creation');
    }

    public function users()
    {
        return $this->service->getUsers();
    }

    public function render()
    {
        return view('livewire.pages.dashboard', [
            'users' => $this->readyToLoad
                ? $this->users()
                : []
        ]);
    }
}
