<?php

namespace App\Livewire\User\Auth;

use App\Livewire\Forms\User\AccountRegisterForm;
use App\Services\UserService;
use Livewire\Attributes\Title;
use Livewire\Component;

class AccountRegister extends Component
{

    public AccountRegisterForm $form;

    #[Title('User Registration')]

    public function save(UserService $service)
    {
        $validatedData = array_filter($this->validate());

        $service->accountRegister($validatedData);
        $this->redirectRoute('user.login');
    }

    public function render()
    {
        return view('livewire.user.auth.account-register');
    }
}
