<?php

namespace App\Livewire;

use App\Livewire\Forms\User\UserCreationForm;
use App\Services\UserService;
use Livewire\Attributes\Title;
use Livewire\Component;

class UserCreation extends Component
{

    public UserCreationForm $form;

    #[Title('User Creation')]

    public function save(UserService $service)
    {
        $validatedData = array_filter($this->validate());

        $service->accountRegister($validatedData);
        $this->redirectRoute('user.login');
    }

    public function render()
    {
        return view('livewire.user-creation');
    }
}
