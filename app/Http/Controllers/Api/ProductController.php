<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['game', 'merchant'])->paginate(20);
        return response()->json($products);
    }

    public function show(Product $product)
    {
        $product->load('game', 'merchant.user');
        return response()->json($product);
    }
}

