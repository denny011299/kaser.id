<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{
    function index() {
        return view('Cashier.Cashier');
    }
}
