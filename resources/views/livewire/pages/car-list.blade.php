<div>
    <h2>Cars Owned by {{ $user->name }}</h2>

    @if($cars && $cars->count() > 0)
        <ul>
            @foreach($cars as $car)
                <div>
                    <li>{{ $car->make }} - {{ $car->model }} - {{ $car->vin }}</li>
                    <button wire:click="deleteCar({{ $car->id }})">Delete</button>
                </div>
            @endforeach
        </ul>
    @else
        <p>No cars found.</p>
    @endif
    
    <!-- Add car form -->
    <form wire:submit.prevent="addCar">
        <input type="text" wire:model="form.make" placeholder="Make">
        @error('form.make') <span>{{ $message }}</span> @enderror

        <input type="text" wire:model="form.model" placeholder="Model">
        @error('form.model') <span>{{ $message }}</span> @enderror

        <input type="text" wire:model="form.vin" placeholder="Vin">
        @error('form.vin') <span>{{ $message }}</span> @enderror

        <button type="submit">Add Car</button>
    </form>
</div>