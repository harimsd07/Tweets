<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function store(){
        $validate = request()->validate([
            'name'=>'required|min:3|max:40|string',
            'email'=>'required|email|unique:users,email',
            'password' =>'required|confirmed|min:8',
        ]);

        User::create([
            'name' =>$validate['name'],
            'email' =>$validate['email'],
            'password' =>Hash::make($validate['password'],)
        ]);

        return redirect()->route('dashboard')->with('success','Account created successfully');
    }

    public function login(){
        return view('auth.login');
    }

    public function authenticate(){
        $validate = request()->validate([
            'email'=>'required|email',
            'password' =>'required|min:8',
        ]);

        if(auth()->attempt($validate)){
            request()->session()->regenerate();
            return redirect()->route('dashboard')->with('success','Logged in Successfully');
        }


        return redirect()->route('login')->withErrors([
            'email'=>'no matching user found with provided email and password'
        ]);
    }

    public function logout(){
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success','Logged out successfully');
    }
}
