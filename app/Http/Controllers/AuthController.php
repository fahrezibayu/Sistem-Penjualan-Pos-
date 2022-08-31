<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    
    public function __construct()
    {

        date_default_timezone_set("Asia/Jakarta");

    }

    public function index ()
    {

        if (!Session::get('login')) {

            return view("v_login");

        } else {

            if (Auth::user()->role == 'Admin') {
                return redirect('/dashboard');
            } else {
                return redirect('/pos');
            }

        }

    }

    public function sign_in (Request $request) {


        if (Auth::attempt($request->only('username','password'))) {

            Session::put("username",Auth::user()->username);
            Session::put("role",Auth::user()->role);
            Session::put("created_at",Auth::user()->created_at);


            Session::put("login",TRUE);
            
            if (Auth::user()->role == 'Admin') {
                return redirect('/dashboard');
            } else {
                return redirect('/pos');
            }

        } else {
            Session::flash('gagal','Username / password anda mungkin salah.');
            return view("v_login");
        }

    }

    public function sign_out (Request $request)
    {

        $request->session()->forget('login');
        Auth::logout();
        return redirect("/");

    }

}
