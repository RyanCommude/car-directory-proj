<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{

    public function test()
    {
        dd('test');
    }

    public function render()
    {
        return view('livewire.pages.home');
    }
}
