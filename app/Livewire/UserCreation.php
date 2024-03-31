<?php

namespace App\Livewire;

use App\Livewire\Forms\User\UserCreationForm;
use App\Models\User;
use App\Services\UserService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

class UserCreation extends Component
{
    #[Title('User Creation')]

    #[Url]
    public $pid;

    public ?User $user;

    private $service;

    public UserCreationForm $form;

    public function boot(UserService $service)
    {
        $this->service = $service;
    }

    public function mount()
    {
        if (isset($this->pid)){
            $this->user = $this->service->getUser((int) decoder($this->pid));
            $this->form->email = $this->user?->email;
            $this->form->username = $this->user?->username;
            $this->form->password = $this->user?->password;
            $this->form->name = $this->user?->name;
        }
    }

    public function save()
    {
        $this->form->validate();

        is_null($this->pid)
            ? $this->service->register($this->form->all())
            : $this->service->updateDetails($this->user->id, $this->form->all());

        $this->redirectRoute('user-list');

    }

    public function render()
    {
        return view('livewire.pages.user-creation');
    }
}
