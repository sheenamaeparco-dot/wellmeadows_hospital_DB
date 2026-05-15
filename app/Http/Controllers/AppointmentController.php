<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index() 
    {
    return view('appointments.index');
    }

    public function create()
{
    // Later, you'll fetch lists of Patients and Doctors here to fill dropdowns
    return view('appointments.create'); 
}
}
