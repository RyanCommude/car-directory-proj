<?php

namespace App\Livewire\Forms\User;

use Livewire\Attributes\Validate;
use Livewire\Form;

class AccountRegisterForm extends Form
{
    #[Validate('required', message: 'Please Enter your Full Name')]
    #[Validate('min:5', message: 'Full Name too short')]
    public $name = "";

    #[Validate('required', message: 'Please Enter your Email')]
    #[Validate('email', message: 'Please Enter Valid Email')]
    public $email = "";

    #[Validate('required', message: 'Please Enter your username')]
    #[Validate('min:7', message: 'Username too short')]
    public $username = "";

    #[Validate('required', message: 'Please Enter your Password')]
    #[Validate('min:5', message: 'Password too Short')]
    public $password = "";
}
