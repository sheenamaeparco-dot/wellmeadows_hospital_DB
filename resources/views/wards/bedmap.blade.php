@extends('layouts.app')

@section('content')
<style>
    .bm-container { font-family: system-ui, -apple-system, sans-serif; padding: 30px; max-width: 1200px; margin: 0 auto; }
    
    .bm-dashboard-banner {
        background: #ffffff; padding: 24px; border-radius: 12px; margin-bottom: 28px;
        position: relative; overflow: hidden; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.01);
    }
    .bm-dashboard-banner::after {
        content: ''; position: absolute; right: -40px; top: -40px; width: 180px; height: 180px;
        background: rgba(35, 78, 54, 0.02); border-radius: 50%; pointer-events: none;
    }
    .bm-dashboard-title { font-size: 24px; font-weight: 700; color: #234e36; margin: 0 0 6px 0; letter-spacing: 0.5px; }
    .bm-dashboard-subtitle { font-size: 13px; color: #6b7280; margin: 0; opacity: 0.9; }

    .bm-controls-panel { 
        display: flex; justify-content: space-between; align-items: center; background-color: #ffffff; 
        padding: 16px 24px; border-radius: 12px; border: 1px solid #e5e7eb; margin-bottom: 20px; gap: 16px; flex-wrap: wrap; 
    }
    .bm-action-buttons { display: flex; gap: 12px; }
    .bm-btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; font-size: 14px; font-weight: 600; border-radius: 8px; cursor: pointer; transition: all 0.2s; border: 1px solid #d1d5db; background: #ffffff; color: #374151; }
    .bm-btn:hover { background-color: #f9fafb; border-color: #9ca3af; }
    .bm-btn-primary { background-color: #234e36; color: #ffffff; border-color: #234e36; }
    .bm-btn-primary:hover { background-color: #1e422e; border-color: #1e422e; }
    
    .bm-ward-selector { padding: 10px 14px; border-radius: 8px; border: 1px solid #d1d5db; font-size: 14px; font-weight: 600; color: #374151; outline: none; cursor: pointer; background-color: #ffffff; }
    .bm-ward-selector:hover { border-color: #9ca3af; }
    .bm-ward-selector:focus { border-color: #234e36; }

    .bm-legend-row { display: flex; gap: 24px; margin-bottom: 24px; padding-left: 4px; }
    .bm-legend-item { display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 600; color: #4b5563; }
    .bm-dot { width: 16px; height: 16px; border-radius: 4px; }
    .dot-occupied { background-color: #c2f3d2; border: 1px solid #a3e9b9; }
    .dot-vacant { background-color: #ffffff; border: 1px solid #d1d5db; }
    .dot-reserved { background-color: #fef3c7; border: 1px solid #fde68a; }
    
    .bm-board-card { background: #ffffff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02); margin-bottom: 24px; }
    .bm-grid-layout { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
    @media (min-width: 640px) { .bm-grid-layout { grid-template-columns: repeat(4, minmax(0, 1fr)); } }
    @media (min-width: 1024px) { .bm-grid-layout { grid-template-columns: repeat(6, minmax(0, 1fr)); } }
    .bm-bed-box { border-radius: 14px; padding: 16px; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 90px; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s; user-select: none; }
    .bm-bed-box:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); }
    
    /* Highlight style indicator active selected box target border outline look */
    .bm-bed-box.wbm-selected-active { border-color: #234e36 !important; box-shadow: 0 0 0 2px rgba(35, 78, 54, 0.2); }
    
    .bm-bed-number { font-size: 20px; font-weight: 700; margin-bottom: 2px; }
    .bm-bed-status-text { font-size: 13px; font-weight: 600; }
    .bed-occupied { background-color: #c2f3d2; color: #1e4620; border: 1px solid #a3e9b9; }
    .bed-vacant { background-color: #ffffff; color: #9ca3af; border: 1px solid #e5e7eb; }
    .bed-reserved { background-color: #fef7e0; color: #b06000; border: 1px solid #fde68a; }

    /* -------------------------------------------------------------
       BED SELECTION PANEL DETAILS MOVED DOWNWARD BELOW THE GRID 
       ------------------------------------------------------------- */
    .bd-info-card {
        display: none; background-color: #ffffff; border: 1px solid #e5e7eb;
        border-radius: 16px; margin-top: 28px; overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        animation: fadeIn 0.2s ease-out;
    }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }
    .bd-card-header { padding: 16px 24px; border-bottom: 1px solid #f3f4f6; font-size: 16px; font-weight: 700; color: #111827; }
    .bd-table-row { display: flex; padding: 14px 24px; border-bottom: 1px solid #f3f4f6; align-items: center; font-size: 14px; }
    .bd-table-row:last-child { border-bottom: none; }
    .bd-row-label { width: 200px; font-weight: 500; color: #4b5563; }
    .bd-row-value { font-weight: 600; color: #111827; flex-grow: 1; }
    .bd-status-pill { display: inline-block; padding: 4px 14px; background-color: #e6f4ea; color: #137333; font-weight: 600; border-radius: 8px; font-size: 13px; text-transform: capitalize; }

    .ab-modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.4); z-index: 1000; align-items: center; justify-content: center; }
    .ab-modal-overlay.open { display: flex; }
    .ab-modal-window { background-color: #ffffff; border-radius: 16px; width: 100%; max-width: 700px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); padding: 24px; animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1); }
    @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
    .ab-main-title { font-size: 24px; font-weight: 700; color: #111827; margin: 0 0 4px 0; }
    .ab-main-subtitle { font-size: 14px; color: #5f6368; margin: 0 0 24px 0; }
    .ab-section-card { border: 1px solid #e5e7eb; border-radius: 12px; margin-bottom: 20px; overflow: hidden; }
    .ab-section-title-bar { background-color: #fafafa; padding: 12px 18px; font-size: 14px; font-weight: 700; color: #111827; border-bottom: 1px solid #e5e7eb; }
    .ab-section-body { padding: 20px; }
    .ab-form-row-grid { display: grid; grid-template-columns: 1fr; gap: 16px 20px; margin-bottom: 16px; }
    @media (min-width: 580px) { .ab-form-row-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
    .ab-form-group { display: flex; flex-direction: column; }
    .ab-label { font-size: 13px; font-weight: 700; color: #111827; margin-bottom: 6px; }
    .ab-input, .ab-select { padding: 10px 14px; background-color: #f7f6f2; border: 1px solid #dcdad2; border-radius: 10px; font-size: 14px; color: #374151; outline: none; width: 100%; box-sizing: border-box; }
    .ab-input:focus, .ab-select:focus { border-color: #234e36; background-color: #ffffff; }
    .ab-input::placeholder { color: #9ca3af; }
    .ab-input[disabled], .ab-select[disabled] { background-color: #f1f0ea; color: #6b7280; cursor: not-allowed; }
    .ab-divider { border: 0; border-top: 1px solid #e5e7eb; margin: 12px 0 20px 0; }
    .ab-modal-footer-row { display: flex; gap: 12px; padding-top: 4px; }
    .ab-footer-btn { padding: 12px 24px; font-size: 14px; font-weight: 700; border-radius: 8px; cursor: pointer; border: 1px solid #d1d5db; }
    .ab-btn-confirm { background-color: #ffffff; color: #111827; border: 1px solid #d1d5db; }
    .ab-btn-confirm:hover { background-color: #f9fafb; }
    .ab-btn-cancel { background-color: #ffffff; color: #374151; }
    .ab-btn-cancel:hover { background-color: #f3f4f6; }
</style>

<div class="bm-container">
    <div class="bm-dashboard-banner">
        <h2 class="bm-dashboard-title">Bed Map — {{ $selectedWardName }}</h2>
        <p class="bm-dashboard-subtitle">Overview of real-time clinic ward map configurations, live occupancy tracks, and assignment wizards.</p>
    </div>

    <div class="bm-controls-panel">
        <div class="bm-action-buttons">
            <button class="bm-btn">Update status</button>
            <button class="bm-btn bm-btn-primary" onclick="openAssignBedModal()">Assign bed</button>
        </div>

        <select class="bm-ward-selector" onchange="window.location.href='?ward_id=' + this.value">
            @for($w = 1; $w <= $totalWardsCount; $w++)
                <option value="{{ $w }}" {{ $selectedWard == $w ? 'selected' : '' }}>Switch to Ward {{ $w }}</option>
            @endfor
        </select>
    </div>

    <div class="bm-legend-row">
        <div class="bm-legend-item"><div class="bm-dot dot-occupied"></div> Occupied</div>
        <div class="bm-legend-item"><div class="bm-dot dot-vacant"></div> Vacant</div>
        <div class="bm-legend-item"><div class="bm-dot dot-reserved"></div> Reserved</div>
    </div>

    <!-- Main Grid Board Panel -->
    <div class="bm-board-card">
        <div class="bm-grid-layout">
            @foreach($bedsList as $bed)
                <div class="bm-bed-box bed-{{ $bed->status }}" 
                     id="bedBoxInstance_{{ $bed->bed_number }}"
                     data-bed-num="{{ $bed->bed_number }}"
                     data-status="{{ $bed->status }}"
                     data-patient="{{ $bed->status === 'occupied' ? 'Ronald MacDonald · P10034' : '' }}"
                     data-admit="{{ $bed->status === 'occupied' ? '12-Jan-96' : '' }}"
                     data-leave="{{ $bed->status === 'occupied' ? '17-Jan-96' : '' }}"
                     onclick="handleBedBoxClick(this)">
                    <span class="bm-bed-number">{{ $bed->bed_number }}</span>
                    <span class="bm-bed-status-text">{{ $bed->label }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- MOVED SELECTION CARD: NOW POSITIONED CLEANLY DOWN AT THE BOTTOM -->
    <div class="bd-info-card" id="bedDetailDrawerCard">
        <div class="bd-card-header" id="drawerBedTitle">Bed 00 — selected</div>
        <div class="bd-table-row">
            <div class="bd-row-label">Patient</div>
            <div class="bd-row-value" id="drawerPatientValue">Ronald MacDonald · P10034</div>
        </div>
        <div class="bd-table-row">
            <div class="bd-row-label">Date admitted</div>
            <div class="bd-row-value" id="drawerAdmittedValue">12-Jan-96</div>
        </div>
        <div class="bd-table-row">
            <div class="bd-row-label">Expected leave</div>
            <div class="bd-row-value" id="drawerLeaveValue">17-Jan-96</div>
        </div>
        <div class="bd-table-row">
            <div class="bd-row-label">Status</div>
            <div class="bd-row-value">
                <span class="bd-status-pill" id="drawerStatusBadge">In ward</span>
            </div>
        </div>
    </div>
</div>

<!-- ASSIGN BED MODAL DIALOG -->
<div class="ab-modal-overlay" id="assignBedModalContainer" onclick="closeAssignBedModal()">
    <div class="ab-modal-window" onclick="event.stopPropagation()">
        <h2 class="ab-main-title">Assign bed</h2>
        <p class="ab-main-subtitle">Allocate a vacant bed to a patient</p>
        
        <form id="assignBedMockForm" onsubmit="handleMockSubmit(event)">
            <div class="ab-section-card">
                <div class="ab-section-title-bar">Bed details</div>
                <div class="ab-section-body">
                    <div class="ab-form-row-grid">
                        <div class="ab-form-group">
                            <label class="ab-label">Ward</label>
                            <input type="text" class="ab-input" value="{{ $selectedWardName }}" disabled>
                        </div>
                        <div class="ab-form-group">
                            <label class="ab-label">Bed number</label>
                            <select class="ab-select" id="modalBedSelectField" required>
                                <option value="" disabled selected>Select vacant bed...</option>
                                @foreach($vacantBeds as $vBed)
                                    <option value="{{ $vBed->bed_number }}">Bed {{ $vBed->bed_number }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="ab-section-card">
                <div class="ab-section-title-bar">Patient details</div>
                <div class="ab-section-body">
                    <div class="ab-form-row-grid">
                        <div class="ab-form-group">
                            <label class="ab-label">Patient number</label>
                            <input type="text" class="ab-input" placeholder="e.g. P10451" required>
                        </div>
                        <div class="ab-form-group">
                            <label class="ab-label">Full name</label>
                            <input type="text" class="ab-input" placeholder="Search patient..." required>
                        </div>
                    </div>
                    <div class="ab-form-row-grid">
                        <div class="ab-form-group">
                            <label class="ab-label">Date placed in ward</label>
                            <input type="date" class="ab-input" id="datePlacedInWardInput" required onchange="calculateLeaveDate()">
                        </div>
                        <div class="ab-form-group">
                            <label class="ab-label">Expected leave date</label>
                            <input type="text" class="ab-input" id="expectedLeaveDateInput" placeholder="Auto-calculated" disabled>
                        </div>
                    </div>
                    <div class="ab-form-row-grid" style="margin-bottom:0;">
                        <div class="ab-form-group">
                            <label class="ab-label">Expected stay (days)</label>
                            <input type="number" class="ab-input" id="expectedStayDaysInput" placeholder="Enter days" min="1" required oninput="calculateLeaveDate()">
                        </div>
                        <div class="ab-form-group">
                            <label class="ab-label">Date on waiting list</label>
                            <input type="date" class="ab-input" required>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="ab-divider">
            <div class="ab-modal-footer-row">
                <button type="submit" class="ab-footer-btn ab-btn-confirm">✓ Confirm assignment</button>
                <button type="button" class="ab-footer-btn ab-btn-cancel" onclick="closeAssignBedModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Tracker variable to manage toggle states seamlessly
    let activeSelectedBedNum = null;

    function openAssignBedModal() { document.getElementById('assignBedModalContainer').classList.add('open'); }
    function closeAssignBedModal() { document.getElementById('assignBedModalContainer').classList.remove('open'); document.getElementById('assignBedMockForm').reset(); document.getElementById('expectedLeaveDateInput').value = ''; }
    
    // Core selection toggle and routing engine script
    function handleBedBoxClick(element) {
        const bedNum = element.getAttribute('data-bed-num');
        const status = element.getAttribute('data-status');
        const card = document.getElementById('bedDetailDrawerCard');

        // Clear green active outline borders from previous items
        document.querySelectorAll('.bm-bed-box').forEach(box => box.classList.remove('wbm-selected-active'));

        if (status === 'vacant') {
            card.style.display = 'none';
            activeSelectedBedNum = null;
            openAssignBedModal();
            document.getElementById('modalBedSelectField').value = bedNum;
            return;
        }

        // TOGGLE LOGIC: If clicking the SAME open bed card, hide it instantly!
        if (activeSelectedBedNum === bedNum) {
            card.style.display = 'none';
            activeSelectedBedNum = null;
            return;
        }

        // Otherwise, open the card and load appropriate data row variables
        activeSelectedBedNum = bedNum;
        element.classList.add('wbm-selected-active');

        if (status === 'occupied') {
            document.getElementById('drawerBedTitle').innerText = `Bed ${bedNum} — selected`;
            document.getElementById('drawerPatientValue').innerText = element.getAttribute('data-patient');
            document.getElementById('drawerAdmittedValue').innerText = element.getAttribute('data-admit');
            document.getElementById('drawerLeaveValue').innerText = element.getAttribute('data-leave');
            
            const badge = document.getElementById('drawerStatusBadge');
            badge.innerText = "In ward";
            badge.style.backgroundColor = "#e6f4ea";
            badge.style.color = "#137333";

            card.style.display = 'block';
            // Smoothly auto-scroll view down onto information drawer panel
            card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        } else if (status === 'reserved') {
            document.getElementById('drawerBedTitle').innerText = `Bed ${bedNum} — selected`;
            document.getElementById('drawerPatientValue').innerText = 'Reservation Pending Assignment';
            document.getElementById('drawerAdmittedValue').innerText = '—';
            document.getElementById('drawerLeaveValue').innerText = '—';
            
            const badge = document.getElementById('drawerStatusBadge');
            badge.innerText = "Reserved";
            badge.style.backgroundColor = "#fff9e6";
            badge.style.color = "#b06000";

            card.style.display = 'block';
            card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }

    function calculateLeaveDate() {
        const placementDateVal = document.getElementById('datePlacedInWardInput').value;
        const durationDaysVal = parseInt(document.getElementById('expectedStayDaysInput').value);
        const outputField = document.getElementById('expectedLeaveDateInput');

        if (placementDateVal && !isNaN(durationDaysVal)) {
            const calculatedDate = new Date(placementDateVal);
            calculatedDate.setDate(calculatedDate.getDate() + durationDaysVal);
            const options = { day: '2-digit', month: 'short', year: '2-digit' };
            outputField.value = calculatedDate.toLocaleDateString('en-GB', options).replace(/ /g, '-');
        } else {
            outputField.value = 'Auto-calculated';
        }
    }

    function handleMockSubmit(e) {
        e.preventDefault();
        alert('Mock form assignment submitted successfully!');
        closeAssignBedModal();
    }
</script>
@endsection
