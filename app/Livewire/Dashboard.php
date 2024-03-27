<?php

namespace App\Livewire;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function logout(UserService $service)
    {
        $service->logout();
        return $this->redirectRoute('user.login');
    }

    public function render()
    {
        return view('livewire.pages.dashboard');
    }
}
