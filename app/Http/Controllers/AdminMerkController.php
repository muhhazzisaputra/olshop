<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merk;
use Illuminate\Support\Facades\Storage;

class AdminMerkController extends Controller
{
    
    public function index() {
        return view('admin/product/merk_list', [
            'title' => 'Merek Produk',
            'merks' => Merk::all()
        ]);
    }

    public function create() {
        return view('admin/product/merk_create', [
            'title'  => 'Tambah Merek Produk'
        ]);
    }

    public function store(Request $request) {
        $validate_data = $request->validate([
            'logo' => 'image|file|max:1024',
            'name' => 'required|max:100'
        ]);

        if($request->file('logo')) {
            $validate_data['logo'] = $request->file('logo')->store('merk-logos');
        } else {
            $validate_data['logo'] = 'no-image.png';
        }

        Merk::create($validate_data);

        return redirect('/admin/merk')->with('success', 'Data berhasil disimpan.'); 
    }

    public function edit(Merk $merk) {
        return view('admin/product/merk_edit', [
            'title' => 'Edit Merek Produk',
            'merk'  => $merk
        ]);
    }

    public function update(Request $request, Merk $merk) {
        $rules = [
            'logo' => 'image|file|max:1024',
            'name' => 'required|max:100'
        ];

        $validate_data = $request->validate($rules);

        if($request->file('logo')) {
            if($request->old_image) {
                Storage::delete($request->old_image);
            }
            $validate_data['logo'] = $request->file('logo')->store('merk-logos');
        }

        Merk::where('id', $merk->id)->update($validate_data);

        return redirect('/admin/merk')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(Merk $merk)
    {
        if($merk->logo) {
            Storage::delete($merk->logo);
        }

        Merk::destroy($merk->id);

        return redirect('/admin/merk')->with('success', 'Data berhasil dihapus.');
    }

}
