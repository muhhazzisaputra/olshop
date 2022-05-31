<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;

class AdminSizeController extends Controller
{
    
    public function index()
    {
        return view('admin/product/size_list', [
            'title' => 'Ukuran Produk',
        ]);
    }

    public function read()
    {
        $data = Size::orderBy("id", "desc")->get();
        return view('admin/product/size_read')->with([
            'sizes' => $data
        ]);
    }

    public function create()
    {
        return view('admin/product/size_create');
    }

    public function store(Request $request)
    {
        $data['name'] = $request->name;
        Size::insert($data);
    }

    public function show($id)
    {
        $data = Size::findOrFail($id);
        return view('admin/product/size_edit')->with([
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Size::findOrFail($id);
        $data->name = $request->name;
        $data->save();
    }

    public function destroy($id)
    {
        $data = Size::findOrFail($id);
        $data->delete();
    }

}