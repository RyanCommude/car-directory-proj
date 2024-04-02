<div>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Directory</span>
            </div>
            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                <button wire:click='logout' class="text-sm  text-blue-600 dark:text-blue-500 hover:underline">Logout</button>
            </div>
        </div>
    </nav>
    <section class="text-black p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white  relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <!-- Start Search Code -->
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-black" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2" placeholder="Search" wire:model.live.debounce.300ms="search">
                            </div>
                        </form>
                        <!-- End Search Code -->
                    </div>
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <!-- Start User Creation Button -->
                        <button type="button" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" wire:click='createRoute'>Create User</button>
                        <!-- End User Creation Button -->
                    </div>
                </div>
                <div class="overflow-x-auto" wire:init="loadUsers">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">
                                    <button wire:click="sortBy('name')">FULL NAME</button>
                                    @if($sortField === 'name')
                                    @if($sortDirection === 'asc') &#8593; @else &#8595; @endif
                                    @endif
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    <button wire:click="sortBy('username')">USERNAME</button>
                                    @if($sortField === 'username')
                                    @if($sortDirection === 'asc') &#8593; @else &#8595; @endif
                                    @endif
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    <button wire:click="sortBy('email')">EMAIL</button>
                                    @if($sortField === 'email')
                                    @if($sortDirection === 'asc') &#8593; @else &#8595; @endif
                                    @endif
                                </th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($users && $users->count() > 0)
                            @foreach($users as $user)
                            <tr class="border-b dark:border-gray-700" wire:key='{{ $user->id }}'>
                                <td class="px-4 py-3">
                                    <button wire:click='showCar({{ $user->id }})'>{{ $user->name }}</button>
                                </td>
                                <td class="px-4 py-3">{{ $user->username }}</td>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3 flex items-center ">
                                    <button type="button" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" wire:click='showUser({{ $user->id }})'>Edit</button>
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
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                    @if($readyToLoad)
                    {{ $users->links(data: ['scrollTo' => false])}}
                    @endif
                </nav>
            </div>
        </div>
    </section>
</div>