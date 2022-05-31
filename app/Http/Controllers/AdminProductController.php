<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;
use Image;
use App\Models\Size;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Session;

class AdminProductController extends Controller
{

    public function data()
    {
        return DataTables::of(Product::query())->toJson();
    }

    public function index()
    {
        return view('admin/product/product_list', [
            'title'    => 'Produk',
            'products' => Product::orderBy("id", 'desc')->get()
        ]);
    }

    public function create()
    {
        return view('admin/product/product_create', [
            'title'      => 'Tambah Produk',
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        return $request;
        $validate = $request->validate([
            'image'          => 'image|file|max:1024',
            'name'           => 'required|max:30',
            'slug'           => 'required|unique:products',
            'category_id'    => 'required',
            'weight'         => 'required',
            'stock'          => 'required',
            'purchase_price' => 'required',
            'selling_price'  => 'required',
            'description'    => 'required',
            'status'         => 'required'
        ]);

        if($request->file('image')) {
            $validate['image'] = $request->file('image')->store('product-images');
        }

        Product::create($validate);

        return redirect('/admin/product')->with('success', 'Data berhasil disimpan.'); 
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        return view('admin/product/product_edit', [
            'title'      => 'Edit Produk',
            'product'    => $product,
            'categories' => Category::all(),
            'sizes'      => Size::all(),
            'images'     => ProductImage::where('product_id', $product->id)->get(),
            'variants'   => ProductVariant::where('product_id', $product->id)->get()
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $rules = [
            'image'          => 'image|file|max:1024',
            'name'           => 'required|max:30',
            'category_id'    => 'required',
            'weight'         => 'required',
            'stock'          => 'required',
            'purchase_price' => 'required',
            'selling_price'  => 'required',
            'description'    => 'required'
        ];

        if($request->slug != $product->slug) {
            $rules['slug'] = 'required|unique:products';
        }

        $validate = $request->validate($rules);

        if($request->status) {
            $validate['status'] = '1';
        } else {
            $validate['status'] = '0';
        }

        if($request->file('image')) {
            if($request->old_image) {
                Storage::delete($request->old_image);
            }
            $validate['image'] = $request->file('image')->store('product-images');
        }

        Product::where('id', $product->id)->update($validate);

        return redirect('/admin/product')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(Product $product)
    {
        if($product->image) {
            Storage::delete($product->image);
        }

        Product::destroy($product->id);

        return redirect('/admin/product')->with('success', 'Data berhasil dihapus.');
    }

    public function getSlug(Request $request) 
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    public function uploadImage(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'image'      => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $image    = $request->file('image');
        $fileName = date("YmdHis").'.'.$image->getClientOriginalExtension();

        // get lebar gambar
        $lebar_gambar = Image::make($image)->width();
        $lebar_gambar -= $lebar_gambar * 50 / 100;
        Image::make($image)->resize($lebar_gambar, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('product-thumbnails/'.$fileName));

        unset($validatedData['image']);
        $validatedData['image_gallery'] = $image->store('product-images');
        $validatedData['thumbnail']     = 'product-thumbnails/'.$fileName;

        ProductImage::create($validatedData);

        $product = Product::find($request->product_id);

        return redirect('/admin/product/'.$product->slug.'/edit')->with('image', 'Gambar berhasil diupload.');
    }

    public function deleteImage($id)
    {
        $productImage = ProductImage::find($id);

        Storage::delete($productImage->image_gallery);
        Storage::delete($productImage->thumbnail);

        productImage::destroy($id);

        $product = Product::find($productImage->product_id);

        return redirect('/admin/product/'.$product->slug.'/edit')->with('image', 'Gambar berhasil dihapus.');
    }

    public function storeVariant(Request $request)
    {
        $data = [
            'product_id'     => $request->product_id,
            'size_id'        => $request->size_id,
            'stock'          => $request->stock_variant,
            'purchase_price' => $request->purchase_price_variant,
            'selling_price'  => $request->selling_price_variant
        ];

        $product = Product::find($request->product_id);
        
        ProductVariant::create($data);

        return redirect('/admin/product/'.$product->slug.'/edit')->with('variant', 'Data varian berhasil disimpan.');
    }

}