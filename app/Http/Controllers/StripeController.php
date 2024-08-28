<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;

use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\View\View;
use \Illuminate\Foundation\Application;

class StripeController extends Controller
{

    /**
     * @throws ApiErrorException
     */
    public function checkout(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_name'  => 'required|string',
            'product_price' => 'required|numeric|min:0',
            'product_id'    => 'required|integer',
        ]);

        Stripe::setApiKey(config('stripe.test.sk'));
        $session = Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            'name' => $validated['product_name'],
                        ],
                        'unit_amount'  => $validated['product_price'],
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('success',[
                'product_id' => $validated['product_id'],
                'product_name' => $validated['product_name'],
                'product_price' => $validated['product_price'],
            ]),
            'cancel_url'  => route('shopping'),

        ]);

        return redirect()->away($session->url);

    }


    public function success(Request $request): Factory|View|Application
    {
        $productId = $request->query('product_id');
        $productName = $request->query('product_name');
        $productPrice = $request->query('product_price');


        $product = Product::find($productId);

        $sailCount = intval($product->sale_count) + 1;

        if ($product) {
            $product->sale_count = $sailCount;
            $product->save();
        }

        return view('livewire.pages.success', compact('productId', 'productName', 'productPrice', 'sailCount'));
    }
}
