<div>
<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
        <div class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Cars Owned by {{ $user->name }}</span>
        </div>
        <div class="flex items-center space-x-6 rtl:space-x-reverse">
            <a href="#" class="text-sm  text-blue-600 dark:text-blue-500 hover:underline" wire:click="createRoute">Back</a>
        </div>
    </div>
</nav>
<div class="relative overflow-x-auto shadow-md ">
<div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
        <div>
            <form wire:submit.prevent="addCar">
                <div class=" flex justify-center gap-10 items-center h-[90px]">
                    <div>
                        @error('form.make') <p class=" text-red-500 text-sm">{{ $message }}</p> @enderror
                        <input type="text" wire:model="form.make" placeholder="Make">
                    </div>
                    
                    <div>
                        @error('form.model') <p class=" text-red-500 text-sm">{{ $message }}</p> @enderror
                        <input type="text" wire:model="form.model" placeholder="Model">
                    </div>
                    
                    <div>
                        @error('form.vin') <p class=" text-red-500 text-sm">{{ $message }}</p> @enderror
                        <input type="text" wire:model="form.vin" placeholder="Vin">
                    </div>
                
                <button type="submit" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Add Car</button>
                </div>
            </form>
        </div>   
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-black">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Make
                </th>
                <th scope="col" class="px-6 py-3">
                    Model
                </th>
                <th scope="col" class="px-6 py-3">
                    Vin
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
        @if($cars && $cars->count() > 0)
            @foreach($cars as $car)
                <tr class="bg-white border-b hover:bg-gray-50 ">
                <td class="px-6 py-4">
                {{ $car->make }}
                </td>
                <td class="px-6 py-4">
                {{ $car->model }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                         {{ $car->vin }}
                    </div>
                </td>
                <td class="px-6 py-4">
                    <button wire:click="deleteCar({{ $car->id }})">Delete</button>
                </td>
            @endforeach
            @else
            <td class="px-6 py-4">
                <p>No cars found.</p>
            </td>
            </tr>
            @endif  
        </tbody>
    </table>
</div> 
</div>
