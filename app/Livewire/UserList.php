<?php

namespace App\Livewire;

use App\Services\UserService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination, WithoutUrlPagination;

    private $service;

    public $readyToLoad = false;

    public $search = '';

    public $sortField = 'name';

    public $sortDirection = 'asc';

    public $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function boot(UserService $service)
    {
        $this->service = $service;
    }

    public function loadUsers()
    {
        $this->readyToLoad = true;
    }

    public function sortBy($field)
    {   
        if ($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function resetFilters()
    {
        $this->reset(['search', 'sortField', 'sortDirection']);
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
        $query = $this->service->getUsers(false)->toQuery();

        if ($this->search) {
            $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('username', 'like', '%' . $this->search . '%');
            });
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        return $query->paginate(5);
    }

    public function showUser(int $id)
    {
        $user = $this->service->getUser($id);

        $this->redirectRoute('user-creation', [
            'pid' => encoder((string) $user->id)
        ]);
    }

    public function showCar(int $id)
    {
        $user = $this->service->getUser($id);

        $this->redirectRoute('car-list', [
            'pid' => encoder((string) $user->id)
        ]);
    }

    public function render()
    {
        return view('livewire.pages.user-list', [
            'users' => $this->readyToLoad
                ? $this->users()
                : []     
        ]);
    }
}
