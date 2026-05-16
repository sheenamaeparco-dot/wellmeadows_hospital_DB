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

     public function bedmap(Request $request)
    {
        $selectedWard = $request->query('ward_id', 1); 
        $totalWardsCount = 17;
        $bedsPerWardCount = 14;

        $wardSpecializations = [
            1 => 'General Medicine', 2 => 'Pediatrics', 3 => 'Cardiology', 4 => 'Neurology',
            5 => 'Oncology', 6 => 'ICU', 7 => 'Maternity', 8 => 'Psychiatry',
            9 => 'Geriatrics', 10 => 'Dermatology', 11 => 'Orthopaedic', 12 => 'Gastroenterology',
            13 => 'Nephrology', 14 => 'Pulmonology', 15 => 'Urology', 16 => 'ER Overflow', 17 => 'Isolation'
        ];
        
        $selectedWardName = "Ward " . $selectedWard . " — " . ($wardSpecializations[$selectedWard] ?? 'General');

        $bedNumberStartOffset = (($selectedWard - 1) * $bedsPerWardCount) + 1;
        $bedsList = [];
        $statusOptions = ['occupied', 'vacant', 'reserved'];

        for ($i = 0; $i < $bedsPerWardCount; $i++) {
            $currentBedNumber = $bedNumberStartOffset + $i;
            $mockStatus = $statusOptions[($currentBedNumber) % 3]; 
            $shortLabel = ($mockStatus == 'occupied') ? 'Occ' : (($mockStatus == 'reserved') ? 'Res' : 'Free');

            $bedsList[] = (object)[
                'bed_number' => $currentBedNumber,
                'status'     => $mockStatus,
                'label'      => $shortLabel,
                'patient'    => $mockStatus === 'occupied' ? 'Ronald MacDonald · P100' . $currentBedNumber : '',
                'admit'      => $mockStatus === 'occupied' ? '12-Jan-96' : '',
                'leave'      => $mockStatus === 'occupied' ? '17-Jan-96' : ''
            ];
        }

        $vacantBeds = array_filter($bedsList, function($bed) {
            return $bed->status === 'vacant';
        });

        return view('wards.bedmap', compact('selectedWard', 'selectedWardName', 'totalWardsCount', 'bedsList', 'bedsPerWardCount', 'vacantBeds'));
    }




public function requisitions() {
    return view('wards.requisitions');
}


}


