<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductUpload;
use Image;
use Intervention\Image\Exception\NotReadableException;

class ImageUploadController extends Controller
{
    
    public function index()
    {
        return view('image-intervention');
    }

    public function upload(Request $request)
    {
        /*========================================================================== VERSI 1 =============================================*/
        /*
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $file = $request->file('image');
             
        // for save original image
        $ogImage      = Image::make($file);
        $originalPath = public_path('public/storage/product-images/';
        $ogImage      = $ogImage->save($originalPath.time().$file->getClientOriginalName());
         
        // for store resized image
        $thumbnailPath = 'public/thumbnail/';
        $ogImage->resize(250,125);
        $thImage = $ogImage->save($thumbnailPath.time().$file->getClientOriginalName());

        $save = new ProductUpload;
        $save->original_img = $ogImage;
        $save->thumb_img = $thImage;
        $save->save();

        return redirect('image')->with('status', 'Image Has been uploaded successfully with validation in laravel');
        */

        /*========================================================================== VERSI 2 =============================================*/
        /*
        $image    = $request->image;
        $fileName = $image->getClientOriginalName();

        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(300, 300);
        $image_resize->save(public_path('product-thumbnails/'.$fileName));

        return "Image has been resized successfully";
        */

        /*========================================================================== VERSI 3 =============================================*/
        $image = $request->file('image');
        if($image) {
            $nama_gambar = 'sangcahayaid-' . time() . $image->getClientOriginalName();
            // get lebar gambar
            $lebar_gambar = Image::make($request->file('image'))->width();
            $lebar_gambar -= $lebar_gambar * 50 / 100;
            Image::make($request->file('image'))->resize($lebar_gambar, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('product-thumbnails/'.$nama_gambar));
            
            echo '<pre>';
            print_r($nama_gambar);
        }
    }

}
