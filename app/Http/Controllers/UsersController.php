<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    // public function login(Request $request){
    //     $credentials = $request->only('u', 'password');
    //     if(Auth::attempt($credentials)){
    //         return redirect()->route('dashboard');
    //     }
    //     else {
    //         return redirect()->back()->withInput()->withErrors(['email'=> 'Invalid credentials']);
    //     }
    // }
    public function login()
    {
        return view('login');
    }

    public function login_submit(Request $request)
    {
        validator(request()->all(), [
            'email' => ['required', 'email'],
            'password' => ['required']
        ])->validate();

        $credentials = $request->only('email', 'password');
            if(Auth::attempt($credentials)){
                return redirect()->route('add_orders');
            }
            else {
                return redirect()->back()->withInput()->withErrors(['email'=> 'Invalid credentials']);
            }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
