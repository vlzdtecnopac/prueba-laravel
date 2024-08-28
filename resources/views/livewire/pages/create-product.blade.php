<?php
use \App\Models\Product;
use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.app');

state([
    'name' => '',
    'price' => '',
    'category' => '',
    'isActive' => true,
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'price' => ['required', 'numeric', 'min:0'],
    'category' => ['required', 'string', 'in:Alimentos,Aseo,Carnicos,Frutas y Verduras,Tecnologia'],
    'isActive' => ['boolean']
]);

$register = function () {
    $validated = $this->validate();

    // Lógica para registrar el producto en la base de datos
    Product::create($validated);

    // Limpiar los campos después de registrar
    $this->reset(['name', 'price', 'category', 'isActive']);

    // Redirigir o enviar un mensaje de éxito
    $this->redirect(route('dashboard', absolute: false), navigate: true);
};


?>

<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form wire:submit.prevent="register" novalidate>
            <!-- Campos del formulario -->
            <div class="mt-4">
                <x-input-label for="name" :value="__('Nombre Producto')"/>
                <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name"
                              required autofocus autocomplete="name"/>
                <x-input-error :messages="$errors->get('product')" class="mt-2"/>
            </div>

            <div class="mt-4">
                <x-input-label for="price" :value="__('Precio')"/>
                <x-text-input wire:model="price" id="price" class="block mt-1 w-full" type="text" name="price" required
                              autofocus autocomplete="price"/>
                <x-input-error :messages="$errors->get('price')" class="mt-2"/>
            </div>

            <div class="mt-4">
                <label for="category"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-950">{{__('Seleccione la categoria')}}</label>
                <select name="category" wire:model="category" id="category"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-950 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>{{__('Seleccione la categoria')}}</option>
                    <option value="Alimentos">{{__('Alimentos')}}</option>
                    <option value="Aseo">{{__('Aseo')}}</option>
                    <option value="Carnicos">{{__('Carnicos')}}</option>
                    <option value="Frutas y Verduras">{{__('Frutas y Verduras')}}</option>
                    <option value="Tecnologia">{{__('Tecnologia')}}</option>
                </select>
            </div>

            <x-switch-form id="isActiveSwitch" name="isActive" :value="1" :checked="$isActive">
                {{ __('Activo') }}
            </x-switch-form>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
    </div>
</form>
    </div>
</div>

