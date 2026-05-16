<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        return view('staff.index');
    }

    public function management()
    {
        return view('staff.management');
    }

    public function departments()
    {
        return view('staff.departments');
    }

    public function schedules()
    {
        return view('staff.schedules');
    }
}
