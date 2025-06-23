<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GeneralController extends Controller
{
   function index() {
        return view('Backoffice.Dashboard');
   }
   
    function login() {
        if(session()->has('user')) {
            return redirect('/admin/');
        }
        return view('BackOffice.Login');
    }

    function mekanismeLogin(Request $req) {
        
    }

    function logout() {
        Session::flush();
        return redirect('/');
    }
    // about

}
