<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    
    public function index() {
        return view('register/index', [
            'categories' => Category::all(),
            'title'      => 'Register'
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name'     => 'min:4|max:100',
            'email'    => 'email|unique:customers',
            'whatsapp' => 'min:10|max:16',
            'password' => 'min:5|max:100'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['username'] = Str::beforeLast($request->email, '@');
        $validatedData['role']     = '1';

        User::create($validatedData);

        // opsi alert 1
        /*
        $request->session()->flash('success', 'Registration successfull!. Please login');
        */

        return redirect('/login')->with('success', 'Registrasi berhasil!. Silahkan login');
    }

}
