<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;

class ProductTable extends Component
{
    public $products;
    public bool $isEditing = false;
    public bool $isDetails= false;

    protected $listeners = ['toggleState' => 'updateState'];

    public $productId;
    public $name;
    public $isActive;
    public $price;

    public function mount()
    {
       $this->products = Product::all();
    }

    public function updateState(): void
    {
        $this->isActive = !$this->isActive;
    }

    public function edit($id): void
    {
        $product = Product::find($id);

        if ($product) {
            $this->productId = $product->id;
            $this->name = $product->name;
            $this->isActive = $product->isActive;
            $this->price = $product->price;
            $this->isEditing = true;
        }
    }

    public function update(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'isActive' => 'required|bool',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::find($this->productId);

        if ($product) {
            $product->name = $this->name;
            $product->isActive = $this->isActive;
            $product->price = $this->price;
            $product->save();
            $this->products = Product::all();
            $this->isEditing = false;
            session()->flash('message', 'Producto actualizado exitosamente.');
        }
    }
    public function delete($id): void
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            session()->flash('message', 'Producto eliminado exitosamente.');
        }
        $this->products = Product::all();
    }

    public function cancelUpdateForm(): void
    {
        $this->isEditing = false;
    }

    public function details($id): void
    {
        $product = Product::find($id);
        if($product){
            $this->isDetails = true;
            $product->name = $this->name;
            $product->isActive = $this->isActive;
            $product->price = $this->price;
        }

    }

    public  function cancelDetails(): void
    {
        $this->isDetails = false;
    }

    public function render(): View
    {
        return view('livewire.component.product-table');
    }
}
