<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{

    public function index() { 
        return view('home', [
            'title'      => 'Home',
            'categories' => Category::all(),
            'products'   => Product::select("*")
                                     ->where("status", "1")
                                     ->orderBy("id", 'desc')
                                     ->limit(8)->get()
        ]);
    }

}