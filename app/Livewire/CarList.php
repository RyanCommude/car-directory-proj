<?php

namespace App\Livewire;

use App\Livewire\Forms\User\CarCreationForm;
use App\Models\User;
use App\Services\CarService;
use App\Services\UserService;
use Livewire\Attributes\Url;
use Livewire\Component;

class CarList extends Component
{
    #[Url]
    public $pid;

    public ?User $user;

    private $service;

    public $cars;

    public CarCreationForm $form;

    public function boot(UserService $service)
    {
        $this->service = $service;
    }

    public function mount(CarService $service)
    {
        if (isset($this->pid)){
            $this->user = $this->service->getUser((int) decoder($this->pid));
            if ($this->user) {
                $this->cars = $service->getCars($this->user->name);
            }
        }
    }

    public function createRoute()
    {
        return redirect()->route('user-list');
    }

    public function refreshComponent(CarService $service): void
    {
        $this->cars = $service->getCars($this->user->name);
    }

    public function addCar(CarService $service)
    {
        $this->form->validate();

        if(!$this->user){
            return;
        }

        $existingCar = $service->getCarByModelForUser($this->user->name, $this->form->model);

        if ($existingCar) {
            
            $this->addError('form.model', 'A car with this model already exists.');
            return;
        }

        $data = [
            'name' => $this->user->name,
            'make' => $this->form->make,   
            'model' => $this->form->model, 
            'vin' => $this->form->vin,
        ];

        $service->addCar($data);

        $this->form->reset();
        
        $this->refreshComponent($service);
    }

    public function deleteCar(int $carId, CarService $service): void
    {
        $service->deleteCar($carId);
        $this->cars = $service->getCars($this->user->name); // Refresh car list after deletion
    }

    public function render()
    {
        return view('livewire.pages.car-list', [
            'cars' => $this->cars,
        ]);
    }
}
