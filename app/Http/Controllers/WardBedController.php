<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //

class WardBedController extends Controller
{

public function index()
    {
        // 1. Static counts for the summary cards
        $occupiedBeds = 2;
        $availableBeds = 238;
        $totalBeds = 240;
        $waitingList = 0;

        // 2. Exactly 2 static row entries to test the table layout
        $activeWards = [
            (object)[
                'bed_id' => 'ICU-310',
                'patient_name' => 'Anna Roberts',
                'patient_code' => '007231',
                'status' => 'available',
                'length_of_stay' => '3',
                'ward' => 'ICU'
            ],
            (object)[
                'bed_id' => 'GEN-222',
                'patient_name' => 'Emily Chen',
                'patient_code' => '007231',
                'status' => 'occupied',
                'length_of_stay' => '2.1',
                'ward' => 'General'
            ]
        ];

        // 3. Send all data arrays down to the layout view template
        return view('wards.index', compact(
            'occupiedBeds', 
            'availableBeds', 
            'totalBeds', 
            'waitingList', 
            'activeWards'
        ));
    }


public function bedmap() {
    return view('wards.bedmap');
}

public function requisitions() {
    return view('wards.requisitions');
}


}


