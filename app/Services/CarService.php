<?php

namespace App\Services;

use App\Models\Car;
use App\Repositories\CarRepository;
use Illuminate\Database\Eloquent\Collection;

class CarService 
{
  public function __construct(
    private CarRepository $carRepository,
  ) {
    
  }

  public function addCar(array $data): void
  {
    $this->carRepository->create($data);
  }

  public function getCars(string $userName): Collection
  {
      return Car::where('name', $userName)->get();
  }

  public function deleteCar(int $carId): void
  {
      $this->carRepository->delete($carId);
  }

  public function getCarByModelForUser(string $userName, string $model): ?Car
  {
      return $this->carRepository->getCarByModelForUser($userName, $model);
  }
}