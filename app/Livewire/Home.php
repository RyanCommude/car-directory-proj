<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{

    public function createRoute()
    {
        return redirect()->route('user.login');
    }

    public function render()
    {
        return view('livewire.pages.home');
    }
}
