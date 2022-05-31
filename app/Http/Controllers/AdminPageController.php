<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class AdminPageController extends Controller
{
    
    public function show(Page $page) 
    {
        return view('admin/page/page_detail', [
            'title' => 'Halaman '.$page->title,
            'page'  => $page
        ]);
    }

    public function update(Request $request, Page $page) 
    {
        $validate['content'] = $request->content;

        if($request->file('img')) {
            $validate['img'] = $request->file('img')->store('page-images');
        }

        Page::where('id', $page->id)->update($validate);

        return redirect('/admin/page/'.$page->slug)->with('success', 'Data berhasil diupdate.');
    }

}
