<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requisition; 

class WardBedController extends Controller
{

public function index() {
    return view('wards.index');
}

public function bedmap() {
    return view('wards.bedmap');
}

public function requisitions() {
    return view('wards.requisitions');
}


}


