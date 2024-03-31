<?php

namespace App\Livewire\Forms\User;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CarCreationForm extends Form
{
    #[Validate('required', message: 'Please Enter Car Make')]
    public $make = "";

    #[Validate('required', message: 'Please Enter Car Model')]
    public $model = "";

    #[Validate('required', message: 'Please Enter Car Vin')]
    public $vin = "";
}