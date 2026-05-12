<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WellMeadows - Ward Requisitions</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: Arial, sans-serif;
        }

        body{
            background:#f4f6f9;
        }

        .container{
            display:flex;
            min-height:100vh;
        }

        /* SIDEBAR STYLES */
        .sidebar{
            width:260px;
            background: rgba(107, 3, 3, 0.8);
            color:white;
            padding:25px;
            backdrop-filter: blur(10px);
        }

        .logo-img {
            width: 80px;
            height: auto;
            margin-bottom: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .sidebar .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
            text-align: center;
            color: white;
        }

        .sidebar-menu a{
            display:block;
            color:white;
            text-decoration:none;
            padding:15px;
            border-radius:10px;
            margin-bottom:10px;
            transition:0.3s;
        }

        .sidebar-menu a:hover{
            background: #5a1e1e;
        }

        /* SUBMENU SYSTEM DROPDOWN */
        .submenu {
            padding-left: 15px;
            margin-bottom: 10px;
            margin-top: -5px;
            display: block;
        }

        .hidden {
            display: none !important;
        }

        .submenu a {
            display: block;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 5px;
            font-size: 14px;
            transition: 0.2s;
        }

        .submenu a.active-sub {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            font-weight: bold;
        }

        .submenu a:hover {
            background: #5a1e1e;
            color: white;
        }

        .logout-btn{
            width:90%;
            padding:10px;
            border:none;
            border-radius:10px;
            background: #4f1919;
            color:white;
            font-size:16px;
            font-weight:bold;
            cursor:pointer;
            margin-top:50px;
        }

        /* MAIN REQUISITIONS GRID STYLES */
        .main-content{
            flex:1;
            padding:40px;
            background:#ffffff;
        }

        .header-section {
            margin-bottom: 25px;
        }

        .header-section h2 {
            font-size: 22px;
            color: #111827;
            font-weight: bold;
        }


        .header-section p {
            font-size: 13px;
            color: #6b7280;
            margin-top: 4px;
        }

        /* Custom Dark Crimson Action Trigger Button */
        .new-req-btn {
            background: #7a1c1c;
            color: white;
            border: none;
            padding: 10px 18px;
            font-size: 13px;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 35px;
            transition: background 0.2s;
        }

        .new-req-btn:hover {
            background: #5e1212;
        }

        /* DATA MATRIX TABULAR SCHEMATIC */
        /* 1. The main container that creates the rounded box */
        .table-container {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
            margin-top: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .req-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        /* 2. Header styling with the light gray background */
        .req-table thead {
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        .req-table th {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            padding: 16px 24px; /* Increased padding for better spacing */
            font-weight: bold;
        }

        /* 3. Row and Cell styling */
        .req-table td {
            padding: 20px 24px; /* Matches your image spacing */
            font-size: 14px;
            color: #111827;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle; /* Centers text vertically */
        }

        /* Removes the line from the very last item in the box */
        .req-table tr:last-child td {
            border-bottom: none;
        }

        .item-title {
            font-weight: bold; /* Made bold to match your new image */
            color: #111827;
            display: block;
        }

        .item-subtitle {
            font-size: 11px;
            color: #6b7280;
            margin-top: 2px;
            display: block;
        }


        /* Colored Tag Status Containers */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 500;
            text-align: center;
        }

        .badge.pharmaceutical { background: #e0e7ff; color: #4338ca; }
        .badge.surgical { background: #e0f2fe; color: #0369a1; }
        .badge.non-surgical { background: #f3f4f6; color: #374151; }

        .status-text {
            font-size: 12px;
            font-weight: bold;
        }
        .status-text.pending { color: #d97706; background: #fef3c7; padding: 4px 8px; border-radius: 4px; }
        .status-text.received { color: #059669; background: #ecfdf5; padding: 4px 8px; border-radius: 4px; }

        /* ================= MODAL INTERFACE BACKDROP LAYER ================= */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            backdrop-filter: blur(2px);
        }

        .modal-box {
            background: white;
            width: 650px;
            max-width: 90%;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .modal-header {
            background: #7a1c1c;
            color: white;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 18px;
            font-weight: bold;
        }

        .modal-close {
            background: transparent;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            opacity: 0.8;
        }
        .modal-close:hover { opacity: 1; }

        /* Form segment groupings and input lines */
        .modal-body {
            padding: 24px;
            max-height: 75vh;
            overflow-y: auto;
        }

        .form-section {
            margin-bottom: 24px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 20px;
        }
        .form-section:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .section-heading {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #7a1c1c;
            font-weight: bold;
            margin-bottom: 14px;
        }

        .form-grid {
            display: grid;
            grid-template-cols: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group label {
            font-size: 12px;
            font-weight: bold;
            color: #374151;
        }

        .form-group input, .form-group select, .form-group textarea {
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            color: #111827;
            background: #f9fafb;
        }

        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none;
            border-color: #7a1c1c;
            background: #ffffff;
        }

        .modal-footer {
            background: #f9fafb;
            padding: 16px 24px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            padding: 10px 20px;
            font-size: 13px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            border: none;
        }

        .btn-cancel {
            background: #e5e7eb;
            color: #374151;
        }
        .btn-cancel:hover { background: #d1d5db; }

        .btn-submit {
            background: #7a1c1c;
            color: white;
        }
        .btn-submit:hover { background: #5e1212; }
    </style>
</head>
<body>

<div class="container">

    <!-- SIDEBAR NAVIGATION PANEL -->
    <div class="sidebar">
        <img src="{{ asset('images/logo.png') }}" alt="WellMeadows Logo" class="logo-img">
        <div class="logo">WellMeadows</div>

        <div class="sidebar-menu">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="#">Patients</a>
            <a href="#">Staff & Department</a>

            <a href="javascript:void(0);" id="ward-menu-btn" style="margin-bottom: 5px;">Ward & Bed</a>
            
            <div class="submenu" id="ward-submenu">
                <a href="{{ route('ward.scoreboard') }}" class="{{ request()->routeIs('ward.scoreboard') ? 'active-sub' : '' }}">Scoreboard</a>
                <a href="{{ route('ward.bed-map') }}" class="{{ request()->routeIs('ward.bed-map') ? 'active-sub' : '' }}">Bed map</a>
                <a href="{{ route('ward.requisitions') }}" class="{{ request()->routeIs('ward.requisitions') ? 'active-sub' : '' }}">Requisitions</a>
            </div>

            <a href="#">Appointment & Treatment</a>
            <a href="#">Billing & Reports</a>
            <a href="#">Settings</a>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn" type="submit">Logout</button>
        </form>
    </div>

    <!-- MAIN INTERFACE VIEWPORT -->
       <div class="main-content">
       <div class="header-section">
    <h2 style="font-weight: bold;">Ward Requisitions &middot; {{ $wardName }}</h2>
    <p>Surgical, non-surgical & pharmaceutical supplies</p>

    <!-- WARD SELECTOR DROPDOWN -->
    <div style="margin-top: 15px; display: flex; align-items: center; gap: 10px;">
        <label style="font-size: 13px; font-weight: bold; color: #4b5563;">Switch Ward:</label>
        <select onchange="location = this.value;" style="padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; background: white; font-size: 13px; cursor: pointer;">
            
            @for ($i = 1; $i <= 17; $i++)
                @php $currentWard = "Ward " . $i; @endphp
                <option value="{{ route('ward.requisitions', ['ward' => $currentWard]) }}" 
                    {{ $wardName == $currentWard ? 'selected' : '' }}>
                    {{ $currentWard }}
                </option>
            @endfor

        </select>
    </div>
</div>



        <button class="new-req-btn" id="open-modal-btn">New requisition</button>

        <!-- The new wrapper for the boxed look -->
        <div class="table-container">
            <table class="req-table">
              <thead>
    <tr>
        <th style="width: 15%;">Req No.</th>
        <th style="width: 20%;">Item / Drug</th> <!-- Reduced from 30% -->
        <th style="width: 20%;">Type</th>        <!-- Reduced to move it left -->
        <th style="width: 15%;">Qty</th>
        <th style="width: 18%;">Ordered By</th>
        <th style="width: 12%;">Date Ordered</th>
        <th style="width: 10%;">Status</th>
    </tr>
</thead>

                <tbody>
    @forelse($requisitions as $req)
        <tr>
            <td>{{ $req->req_no }}</td>
            <td>
                <div class="item-title" style="font-weight: bold;">{{ $req->item_name }}</div>
                <div class="item-subtitle">{{ $req->item_subtitle }}</div>
            </td>
            <td>
                <!-- This dynamically applies your pharmaceutical/surgical/etc. colors -->
                <span class="badge {{ strtolower(str_replace(' ', '-', $req->type)) }}">
                    {{ $req->type }}
                </span>
            </td>
            <td>{{ $req->qty }}</td>
            <td>{{ $req->ordered_by }}</td>
            <td>{{ \Carbon\Carbon::parse($req->date_ordered)->format('d-M-y') }}</td>
            <td>
                <span class="status-text {{ strtolower($req->status) }}">
                    {{ $req->status }}
                </span>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" style="text-align: center; padding: 40px; color: #9ca3af;">
                No requisitions found for {{ $wardName }}.
            </td>
        </tr>
    @endforelse
</tbody>

            </table>
        </div> <!-- End of table-container -->
    </div>



<!-- ==================== NEW POPUP FORM MODAL WINDOW CONTAINER ==================== -->
<div class="modal-overlay hidden" id="requisition-modal">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Create New Ward Requisition</h3>
            <button class="modal-close" id="close-modal-x">&times;</button>
        </div>
        
        <!-- Post Endpoint processing form layer wrapper -->
        <form action="{{ route('ward.requisitions.store') }}" method="POST">
            @csrf
           <div class="modal-body">
    
    <!-- SECTION 1: WARD & STAFF DETAILS -->
    <div class="form-section">
        <div class="section-heading">Ward & staff details</div>
        <div class="form-grid">
            <div class="form-group">
                <label for="req_no">Requisition no.</label>
                <input type="text" id="req_no" name="req_no" placeholder="Auto-generated" disabled>
            </div>
            <div class="form-group">
                <label for="date_ordered">Date ordered</label>
                <input type="text" id="date_ordered" name="date_ordered" placeholder="dd-mmm-yy">
            </div>
            <div class="form-group">
    <label for="ward_number">Ward number</label>
    <select id="ward_number" name="ward_number">
        @for ($i = 1; $i <= 17; $i++)
            <option value="Ward {{ $i }}" {{ $wardName == "Ward $i" ? 'selected' : '' }}>Ward {{ $i }}</option>
        @endfor
    </select>
</div>


            <div class="form-group">
                <label for="requisitioned_by">Requisitioned by</label>
                <input type="text" id="requisitioned_by" name="requisitioned_by" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">

            </div>
        </div>
    </div>

    <!-- SECTION 2: ITEM / DRUG DETAILS -->
    <div class="form-section">
        <div class="section-heading">Item / drug details</div>
        <div class="form-grid">
            <div class="form-group">
                <label for="supply_type">Supply type</label>
                <select id="supply_type" name="supply_type">
                    <option value="" disabled selected>Select type...</option>
                    <option value="Pharmaceutical">Pharmaceutical</option>
                    <option value="Surgical">Surgical</option>
                    <option value="Non-surgical">Non-surgical</option>
                </select>
            </div>
            <div class="form-group">
                <label for="item_drug_number">Item / drug number</label>
                <input type="text" id="item_drug_number" name="item_drug_number" placeholder="e.g. 10223">
            </div>
            <div class="form-group full-width">
                <label for="item_drug_name">Item / drug name</label>
                <input type="text" id="item_drug_name" name="item_drug_name" placeholder="Search item or drug...">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" placeholder="e.g. Pain killer">
            </div>
            <div class="form-group">
                <label for="dosage">Dosage (drugs only)</label>
                <input type="text" id="dosage" name="dosage" placeholder="e.g. 10mg/ml">
            </div>
            <div class="form-group">
                <label for="method_of_admin">Method of admin (drugs only)</label>
                <select id="method_of_admin" name="method_of_admin">
                    <option value="" disabled selected>e.g. Oral, IV...</option>
                    <option value="Oral">Oral</option>
                    <option value="IV">IV</option>
                    <option value="Oral / IV">Oral / IV</option>
                    <option value="Topical">Topical</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cost_per_unit">Cost per unit (&pound;)</label>
                <input type="text" id="cost_per_unit" name="cost_per_unit" placeholder="e.g. 27.75">
            </div>
            <div class="form-group">
                <label for="quantity_required">Quantity required</label>
                <input type="text" id="quantity_required" name="quantity_required" placeholder="e.g. 50">
            </div>
        </div>
    </div>

    <!-- SECTION 3: DELIVERY CONFIRMATION -->
    <div class="form-section">
        <div class="section-heading">Delivery confirmation</div>
        <div class="form-grid">
            <div class="form-group">
                <label for="date_received">Date received</label>
                <input type="text" id="date_received" name="date_received" placeholder="dd-mmm-yy">
            </div>
            <div class="form-group">
                <label for="signed_by">Signed by (Charge Nurse)</label>
                <input type="text" id="signed_by" name="signed_by" placeholder="Signature name / ID">
            </div>
        </div>
    </div>

</div>

         <div class="modal-footer">
            <button type="button" class="btn btn-cancel" id="close-modal-btn">Cancel</button>
            <button type="submit" class="btn btn-submit">Submit Requisition</button>
        </div> <!-- Closing footer div -->
    </form> <!-- Move your </form> tag HERE -->
</div> <!-- Closing modal-box div -->


<!-- Navigation dropdown and modal click-trigger events controller scripts -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- Sidebar Drawer Dropdown Logic ---
        var submenu = document.getElementById('ward-submenu');
        if (window.location.pathname.includes('/ward-bed/')) {
            submenu.classList.remove('hidden');
        }
        document.getElementById('ward-menu-btn').addEventListener('click', function() {
            submenu.classList.toggle('hidden');
        });

        // --- Interactive Modal Visibility Window Control Elements ---
        var modal = document.getElementById('requisition-modal');
        var openBtn = document.getElementById('open-modal-btn');
        var closeX = document.getElementById('close-modal-x');
        var closeBtn = document.getElementById('close-modal-btn');

        // Display Modal
        openBtn.addEventListener('click', function() {
            modal.classList.remove('hidden');
        });

        // Hide Modal Hooks
        function hideModal() {
            modal.classList.add('hidden');
        }
        closeX.addEventListener('click', hideModal);
        closeBtn.addEventListener('click', hideModal);

        // Closes the modal workspace automatically if the background filter layer is clicked directly
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                hideModal();
            }
        });
    });
</script>

</body>
</html>
