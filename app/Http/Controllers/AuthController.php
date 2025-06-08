<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view("login");
    }

    public function logout (Request $request){
        Auth::logout();



        $request->session()->invalidate();



        $request->session()->regenerateToken();



        return redirect('login');
    }

    public function auth (Request $request){
         $credentials = $request->validate([

            'email' => ['required', 'email'],

            'password' => ['required'],

        ]);



        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->intended('article');

        }


        return back()->withErrors([

            'email' => 'Email atau Password anda salah',

        ])->onlyInput('email');
    }

    public function sesion(){

    }
}
