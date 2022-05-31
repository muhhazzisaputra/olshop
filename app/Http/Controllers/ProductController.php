<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    
    public function show(Product $product) {
        return view('product/product_detail', [
            'title'      => 'Detail Produk',
            'categories' => Category::all(),
            'product'    => $product,
            'products'   => Product::select("*")
                                 ->where("status", "1")
                                 ->where('category_id', $product->category_id)
                                 ->orderBy("id", 'desc')
                                 ->limit(8)->get()
        ]);
    }

    public function addToCart(Request $request)
    {
        return $request;
    }

}
