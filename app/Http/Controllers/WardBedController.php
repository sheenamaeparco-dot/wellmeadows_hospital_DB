<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requisition; 

class WardBedController extends Controller
{
    public function scoreboard() {
        return view('ward.scoreboard');
    }

    public function bedMap() {
        return view('ward.bed-map');
    }

    public function requisitions(Request $request)
    {
        $wardName = $request->query('ward', 'Ward 1'); 

        $requisitions = Requisition::where('ward_name', $wardName)->get();

        return view('ward.requisitions', compact('wardName', 'requisitions'));
    }

    // This handles saving the data from your "New Requisition" modal
    public function storeRequisition(Request $request)
    {
        // 1. Validate the form data
        $request->validate([
            'item_drug_name' => 'required',
            'quantity_required' => 'required|integer',
            'ward_number' => 'required',
        ]);

        // 2. Create the record in the database
        Requisition::create([
            'req_no' => 'REQ-' . strtoupper(bin2hex(random_bytes(3))), // Generates a random ID like REQ-A1B2C3
            'item_name' => $request->item_drug_name,
            'item_subtitle' => $request->description,
            'type' => $request->supply_type,
            'qty' => $request->quantity_required,
            'ordered_by' => $request->requisitioned_by,
            'ward_name' => $request->ward_number,
            'status' => 'Pending',
            'date_ordered' => now(), // Sets to today's date automatically
        ]);

        // 3. Go back to the page with a success message
        return redirect()->back()->with('success', 'Requisition submitted successfully!');
    }
}


