<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Category;

class PageController extends Controller
{
    
    public function show(Page $page) {
        return view('page/index', [
            'title'      => $page->title,
            'categories' => Category::all(),
            'page'       => $page
        ]);
    }

}
