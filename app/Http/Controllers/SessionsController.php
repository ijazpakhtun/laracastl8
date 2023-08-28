<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    
    public function create(){
        return view('sessions.create');
    }


    public function store(){

        $attributes=request()->validate([

            'email'=> 'required',
            'password'=>'required'
         ]);


         if(auth()->attempt($attributes)){

                session()->regenerate();
                return redirect('/')->with('success', 'Welcome! You have successfully Logged in');
         }

         throw ValidationException::withMessages(['email', 'Your provided credentials are invalid']);
        //  return back()
        //         ->withInput()
        //         ->withErrors(['email' =>'your provided credentials are invalid']);
    
    
    }
    
    
    public function destroy(){

        auth()->logout();
        return redirect('/')->with('success', 'Successfully you have been log out');
    }

}
