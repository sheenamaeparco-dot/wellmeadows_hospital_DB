<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WardBedController extends Controller
{
    public function reports() {
        return view('ward.reports'); // Points to resources/views/ward/reports.blade.php
    }

    public function bedMap() {
        return view('ward.bed-map'); // Points to resources/views/ward/bed-map.blade.php
    }

    public function assignBed() {
        return view('ward.assign-bed'); // Points to resources/views/ward/assign-bed.blade.php
    }

    public function requisitions() {
        return view('ward.requisitions'); // Points to resources/views/ward/requisitions.blade.php
    }
}

