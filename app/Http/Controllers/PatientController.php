<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
{
    return view('patients.index'); // For now, just show the dashboard so it doesn't crash
}
}
