<?php

namespace App\Livewire\User\Auth;

use App\Livewire\Forms\User\LoginForm;
use App\Services\UserService;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    #[Title('Login')]

    public LoginForm $form;

    public function login(UserService $service)
    {
        $validatedData = $this->validate();
        $username = $validatedData['username'];
        $password = $validatedData['password'];

        if ($service->login($username, $password)) {
            return $this->redirectRoute('user-list');
        } else {
            $this->addError('login', 'Invalid username or password');
        }
    }

    public function render()
    {
        return view('livewire.user.auth.login');
    }
}
