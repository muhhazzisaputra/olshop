<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class LoginController extends Controller
{
    
    public function index() {
        return view('login/index', [
            'categories' => Category::all(),
            'title'      => 'Login'
        ]);
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email'    => 'email',
            'password' => 'min:5|max:100'
        ]);

        $credentials['role'] = '1';

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/profile');
        }

        return back()->with('error', 'Login failed!');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

}
