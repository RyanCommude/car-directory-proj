<?php

namespace App\Repositories;

use App\Models\Car;

class CarRepository
{
  public function create(array $data): Car
  {
    return Car::create($data);
  }

  public function delete(int $carId): void
  {
      Car::destroy($carId);
  }

  public function getCarByModelForUser(string $userName, string $model): ?Car
  {
      return Car::where('name', $userName)
                ->where('model', $model)
                ->first();
  }
}