<?php

namespace App\Http\Controllers;

use App\Models\Product;


class StatisticController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('sale_count', 'desc')->take(6)->get();
        $labels = $products->pluck('name')->toArray();
        $data = $products->pluck('sale_count')->toArray();

        return view('statistic', compact('labels', 'data'));
    }
}
