<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        // For now, return a simple view so you know it works
        return view('billings.index'); 
    }
}
