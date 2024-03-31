<?php

namespace App\Livewire\Forms\User;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required', message: 'Please Enter your Username')]
    #[Validate('min:7', message: 'Username too short')]
    public $username = '';

    #[Validate('required', message: 'Please Enter your Password')]
    #[Validate('min:5', message: 'Password too Short')]
    public $password = "";
}
