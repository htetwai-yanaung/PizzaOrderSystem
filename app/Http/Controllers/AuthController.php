<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Direct Login Page
    public function loginPage()
    {
        return view('login');
    }

    // Direct Register Page
    public function registerPage()
    {
        return view('register');
    }

    // Direct dashboard
    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('category#list');
        } else {
            return redirect()->route('user#home');
        }
    }


}
