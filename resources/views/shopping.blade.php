<x-blank-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($products->isEmpty())
            <p>No hay productos</p>
        @else
            <div class="grid grid-cols-4 gap-4">
                @foreach($products as $product)
                    @if($product->isActive)
                        <div
                            class="my-4 max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-white dark:border-gray-400">
                            <h4 class="text-xl text-gray-950 dark:text-gray-950">{{ $product->name }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-600">{{__("Categoria: ")}} {{$product->category}}</p>
                            <h6 class="text-2xl text-gray-700 dark:text-gray-700">
                                ${{ number_format($product->price / 100, 2) }}</h6>
                            <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_name" value="{{$product->name}}}">
                                <input type="hidden" name="product_price" value="{{$product->price}}">
                                <input type="hidden"  name="product_id" value="{{$product->id}}">

                                <button type="submit"
                                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 mt-4">
                                    Pagar Ahora
                                </button>
                            </form>
                        </div>
                    @endif
                @endforeach

            </div>
        @endif
    </div>
</x-blank-layout>

