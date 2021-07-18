<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\User;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) {
            return redirect('/dashboard1');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|string'
        ];

        $messages = [
            'email.required'        => 'Please enter your email.',
            'email.email'           => 'Not a valid email',
            'password.required'     => 'Please enter your password.',
            'password.string'       => 'Not a valid password'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) {
            return redirect('/dashboard1');

        } else {
            Session::flash('error', 'Email atau password salah');
            return redirect()->route('login');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
