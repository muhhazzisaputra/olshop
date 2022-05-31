<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function index() {
        return view('admin/login', [
            'title' => 'Admin Login'
        ]);
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email'    => 'email',
            'password' => 'min:5|max:100'
        ]);

        $credentials['role'] = '0';

        if(Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Login failed!');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin');
    }

}
