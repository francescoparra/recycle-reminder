<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException as ValidationValidationException;

class LoginController extends Controller
{
    public function create(){
        return view('login.create');
    }

    public function store(){
        $attributes = request()->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ]);
        if(! Auth::attempt($attributes)){  
            throw ValidationValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        };
        session()->regenerate();
        $name = auth()->user()->name;

        return redirect('/list')->with('success', "Welcome Back $name !");
    }

    public function destroy(){
        Auth::logout();

        return redirect('/')->with('success', 'Goodbye');
    }
}
