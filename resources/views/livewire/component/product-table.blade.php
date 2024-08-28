<section>
@if (session()->has('message'))
    <div class="p-4 my-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
        <span class="font-medium">{{ session('message') }}</span>
    </div>
@endif
<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                ID
            </th>
            <th scope="col" class="px-6 py-3">
                Porducto
            </th>
            <th scope="col" class="px-6 py-3">
                Categoria
            </th>
            <th scope="col" class="px-6 py-3">
                Precio
            </th>
            <th scope="col" class="px-6 py-3">
                Estado
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr class="bg-white border-b hover:course-pointer hover:bg-gray-100 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap ">
                    {{$product->id}}
                </th>
                <td class="px-6 py-4">
                    {{ $product->name }}
                </td>
                <td class="px-6 py-4">
                    {{ $product->category }}
                </td>
                <td class="px-6 py-4">
                    $ {{number_format($product->price, 2, ',', '.')}}
                </td>
                <td class="px-6 py-4">
                    @if($product->isActive)
                        <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{__("Activo")}}</span>
                    @else
                        <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">{{__("Inactivo")}}</span>
                    @endif
                </td>
                <td class="px-6 py-4 flex">
                    <button wire:click="delete({{ $product->id }})" class="mx-2">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                        </svg>
                    </button>
                    <button wire:click="details({{$product->id}})" class="mx-2">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                  d="M10 3v4a1 1 0 0 1-1 1H5m14-4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z"/>
                        </svg>
                    </button>
                    <button wire:click="edit({{$product->id}})" class="mx-2">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                        </svg>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


    <!-- Modal para editar producto -->
    @if($isEditing)
        <div class="fixed inset-0 flex items-center justify-center bg-blue-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 mx-auto">
                <h2 class="text-xl font-bold mb-4"> {{ __('Editar Producto') }}</h2>
                <form wire:submit.prevent="update">
                    <div class="my-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" id="name" wire:model.defer="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                        @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="my-2">
                        <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                        <input type="text" id="price" wire:model.defer="price" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                        @error('price') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="my-2">
                        <x-switch-form
                            id="isActive"
                            name="isActive"
                            :value="1"
                            :checked="$isActive"
                            state="isActive">
                            {{ __("Cambiar Estado") }}
                        </x-switch-form>
                    </div>

                    <div class="flex items-center justify-end">
                        <x-primary-button wire:click="update" class="ms-4">
                            {{ __('Actualizar') }}
                        </x-primary-button>
                        <button type="button" wire:click="cancelUpdateForm" class="ml-4 text-gray-500">
                            {{ __('Cancelar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Modal para detalles producto -->
    @if($isDetails)
        <div class="fixed inset-0 flex items-center justify-center bg-blue-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 mx-auto">
                <h2 class="text-xl font-bold mb-4"> {{ __('Detalles producto') }}</h2>
                <p>{{ __('Nombre:') }} {{ $product->name }}</p>
                <p>{{__("Precio: $")}} {{number_format($product->price, 2, ',', '.')}}</p>
                <p>{{__("Estado: ")}}
                    @if($product->isActive)
                        <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{__("Activo")}}</span>
                    @else
                        <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">{{__("Inactivo")}}</span>
                    @endif
                </p>
                <div class="flex items-center justify-end">
                    <button type="button" wire:click="cancelDetails" class="ml-4 text-gray-500">
                        {{ __('Cancelar') }}
                    </button>
                </div>
            </div>
        </div>
    @endif

</section>
