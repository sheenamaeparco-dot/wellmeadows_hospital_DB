@extends('layouts.app')

@section('content')

<style>
    .ws-wrap { padding: 10px 0; font-family: 'Poppins', sans-serif; }

    /* Header */
    .ws-header { margin-bottom: 24px; }
    .ws-header h2 { font-size: 22px; font-weight: 700; color: #1a1a1a; }
    .ws-header p  { font-size: 13px; color: #6b7280; margin-top: 3px; }

    /* Toolbar */
    .ws-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .ws-week-nav {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .ws-week-nav button {
        width: 32px; height: 32px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: white;
        cursor: pointer;
        font-size: 14px;
        color: #374151;
        transition: background .2s;
        display: flex; align-items: center; justify-content: center;
    }
    .ws-week-nav button:hover { background: #f0fdf4; border-color: #2d6a4f; color: #2d6a4f; }
    .ws-week-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #111827;
    }
    .ws-week-label i { color: #2d6a4f; }

    .ws-dept-filter {
        padding: 10px 16px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-family: 'Poppins', sans-serif;
        font-size: 13.5px;
        color: #374151;
        background: white;
        outline: none;
        cursor: pointer;
        min-width: 180px;
    }

    /* Legend */
    .ws-legend {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
        flex-wrap: wrap;
        background: white;
        padding: 14px 20px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }
    .ws-legend-label { font-size: 12px; font-weight: 600; color: #374151; margin-right: 4px; }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px;
        color: #374151;
    }
    .legend-dot {
        width: 12px; height: 12px;
        border-radius: 3px;
        flex-shrink: 0;
    }
    .legend-morning  { background: #dbeafe; }
    .legend-afternoon{ background: #fef3c7; }
    .legend-night    { background: #ede9fe; }
    .legend-off      { background: #f3f4f6; border: 1px solid #e5e7eb; }

    /* Schedule card */
    .ws-card {
        background: white;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 4px rgba(0,0,0,.05);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .ws-table {
        width: 100%;
        border-collapse: collapse;
    }
    .ws-table thead th {
        padding: 12px 14px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: #9ca3af;
        text-align: left;
        background: #f9fafb;
        border-bottom: 1px solid #f3f4f6;
    }
    .ws-table thead th:first-child { width: 200px; }
    .ws-table tbody tr {
        border-bottom: 1px solid #f3f4f6;
        transition: background .12s;
    }
    .ws-table tbody tr:last-child { border-bottom: none; }
    .ws-table tbody tr:hover { background: #f0fdf4; }
    .ws-table tbody td {
        padding: 14px;
        font-size: 13px;
        color: #374151;
        font-family: 'Poppins', sans-serif;
        vertical-align: middle;
    }

    /* Staff name cell */
    .ws-staff-name { font-weight: 600; color: #111827; font-size: 13.5px; }
    .ws-staff-meta { display: flex; gap: 6px; margin-top: 4px; align-items: center; }
    .ws-role-badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 99px;
        font-size: 10.5px;
        font-weight: 600;
    }
    .ws-role-doctor { background: #dbeafe; color: #1d4ed8; }
    .ws-role-nurse  { background: #d1fae5; color: #065f46; }
    .ws-role-admin  { background: #fef3c7; color: #92400e; }
    .ws-dept-text   { font-size: 11px; color: #6b7280; }

    /* Shift cells */
    .shift-cell { text-align: center; }
    .shift-pill {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 600;
        min-width: 80px;
        line-height: 1.4;
    }
    .shift-pill .shift-type { font-size: 11.5px; font-weight: 700; }
    .shift-pill .shift-time { font-size: 10px; font-weight: 500; opacity: .85; }

    .shift-morning   { background: #dbeafe; color: #1d4ed8; }
    .shift-afternoon { background: #fef3c7; color: #92400e; }
    .shift-night     { background: #ede9fe; color: #6d28d9; }
    .shift-off       { background: #f3f4f6; color: #9ca3af; font-size: 12px; padding: 6px 10px; border-radius: 8px; display: inline-block; min-width: 80px; text-align: center; }

    /* Summary cards */
    .ws-summary {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }
    .ws-sum-card {
        background: white;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        padding: 18px 22px;
        box-shadow: 0 1px 4px rgba(0,0,0,.04);
    }
    .ws-sum-label {
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin-bottom: 6px;
    }
    .ws-sum-val {
        font-size: 30px;
        font-weight: 800;
        line-height: 1;
    }
    .ws-sum-val.total     { color: #111827; }
    .ws-sum-val.morning   { color: #1d4ed8; }
    .ws-sum-val.afternoon { color: #92400e; }
    .ws-sum-val.night     { color: #6d28d9; }
</style>

<div class="ws-wrap">

    <!-- Header -->
    <div class="ws-header">
        <h2>Work Schedules</h2>
        <p>Manage staff work schedules and shifts</p>
    </div>

    <!-- Toolbar -->
    <div class="ws-toolbar">
        <div class="ws-week-nav">
            <button onclick="changeWeek(-1)"><i class="fas fa-chevron-left"></i></button>
            <div class="ws-week-label">
                <i class="fas fa-calendar-alt"></i>
                <span id="weekLabel">Week of May 4, 2026</span>
            </div>
            <button onclick="changeWeek(1)"><i class="fas fa-chevron-right"></i></button>
        </div>
        <div style="display:flex; align-items:center; gap:10px;">
            <label style="font-size:13px; font-weight:600; color:#374151;">Department:</label>
            <select class="ws-dept-filter" id="deptFilter" onchange="filterDept()">
                <option value="">All Departments</option>
                <option value="Cardiology">Cardiology</option>
                <option value="Emergency">Emergency</option>
                <option value="Neurology">Neurology</option>
                <option value="Pediatrics">Pediatrics</option>
                <option value="Surgery">Surgery</option>
            </select>
        </div>
    </div>

    <!-- Legend -->
    <div class="ws-legend">
        <span class="ws-legend-label">Shift Types:</span>
        <div class="legend-item"><div class="legend-dot legend-morning"></div> Morning (8:00–16:00)</div>
        <div class="legend-item"><div class="legend-dot legend-afternoon"></div> Afternoon (16:00–00:00)</div>
        <div class="legend-item"><div class="legend-dot legend-night"></div> Night (00:00–8:00)</div>
        <div class="legend-item"><div class="legend-dot legend-off"></div> Off</div>
    </div>

    <!-- Schedule Table -->
    <div class="ws-card">
        <table class="ws-table" id="scheduleTable">
            <thead>
                <tr>
                    <th>Staff Member</th>
                    <th id="col-mon">MON 5/4</th>
                    <th id="col-tue">TUE 5/5</th>
                    <th id="col-wed">WED 5/6</th>
                    <th id="col-thu">THU 5/7</th>
                    <th id="col-fri">FRI 5/8</th>
                    <th id="col-sat">SAT 5/9</th>
                    <th id="col-sun">SUN 5/10</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dr. Sarah Johnson -->
                <tr data-dept="Cardiology">
                    <td>
                        <div class="ws-staff-name">Dr. Sarah Johnson</div>
                        <div class="ws-staff-meta">
                            <span class="ws-role-badge ws-role-doctor">Doctor</span>
                            <span class="ws-dept-text">Cardiology</span>
                        </div>
                    </td>
                    <td class="shift-cell"><div class="shift-pill shift-morning"><span class="shift-type">Morning</span><span class="shift-time">8:00–16:00</span></div></td>
                    <td class="shift-cell"><div class="shift-pill shift-morning"><span class="shift-type">Morning</span><span class="shift-time">8:00–16:00</span></div></td>
                    <td class="shift-cell"><span class="shift-off">Off</span></td>
                    <td class="shift-cell"><div class="shift-pill shift-morning"><span class="shift-type">Morning</span><span class="shift-time">8:00–16:00</span></div></td>
                    <td class="shift-cell"><div class="shift-pill shift-afternoon"><span class="shift-type">Afternoon</span><span class="shift-time">16:00–00:00</span></div></td>
                    <td class="shift-cell"><span class="shift-off">Off</span></td>
                    <td class="shift-cell"><span class="shift-off">Off</span></td>
                </tr>

                <!-- Nurse Emily Chen -->
                <tr data-dept="Emergency">
                    <td>
                        <div class="ws-staff-name">Nurse Emily Chen</div>
                        <div class="ws-staff-meta">
                            <span class="ws-role-badge ws-role-nurse">Nurse</span>
                            <span class="ws-dept-text">Emergency</span>
                        </div>
                    </td>
                    <td class="shift-cell"><div class="shift-pill shift-night"><span class="shift-type">Night</span><span class="shift-time">00:00–8:00</span></div></td>
                    <td class="shift-cell"><div class="shift-pill shift-night"><span class="shift-type">Night</span><span class="shift-time">00:00–8:00</span></div></td>
                    <td class="shift-cell"><div class="shift-pill shift-night"><span class="shift-type">Night</span><span class="shift-time">00:00–8:00</span></div></td>
                    <td class="shift-cell"><span class="shift-off">Off</span></td>
                    <td class="shift-cell"><span class="shift-off">Off</span></td>
                    <td class="shift-cell"><div class="shift-pill shift-morning"><span class="shift-type">Morning</span><span class="shift-time">8:00–16:00</span></div></td>
                    <td class="shift-cell"><div class="shift-pill shift-morning"><span class="shift-type">Morning</span><span class="shift-time">8:00–16:00</span></div></td>
                </tr>

                <!-- Dr. Michael Brown -->
                <tr data-dept="Neurology">
                    <td>
                        <div class="ws-staff-name">Dr. Michael Brown</div>
                        <div class="ws-staff-meta">
                            <span class="ws-role-badge ws-role-doctor">Doctor</span>
                            <span class="ws-dept-text">Neurology</span>
                        </div>
                    </td>
                    <td class="shift-cell"><div class="shift-pill shift-afternoon"><span class="shift-type">Afternoon</span><span class="shift-time">16:00–00:00</span></div></td>
                    <td class="shift-cell"><div class="shift-pill shift-afternoon"><span class="shift-type">Afternoon</span><span class="shift-time">16:00–00:00</span></div></td>
                    <td class="shift-cell"><div class="shift-pill shift-morning"><span class="shift-type">Morning</span><span class="shift-time">8:00–16:00</span></div></td>
                    <td class="shift-cell"><div class="shift-pill shift-morning"><span class="shift-type">Morning</span><span class="shift-time">8:00–16:00</span></div></td>
                    <td class="shift-cell"><span class="shift-off">Off</span></td>
                    <td class="shift-cell"><span class="shift-off">Off</span></td>
                    <td class="shift-cell"><div class="shift-pill shift-afternoon"><span class="shift-type">Afternoon</span><span class="shift-time">16:00–00:00</span></div></td>
                </tr>

                <!-- Nurse David Lee -->
                <tr data-dept="Pediatrics">
                    <td>
                        <div class="ws-staff-name">Nurse David Lee</div>
                        <div class="ws-staff-meta">
                            <span class="ws-role-badge ws-role-nurse">Nurse</span>
                            <span class="ws-dept-text">Pediatrics</span>
                        </div>
                    </td>
                    <td class="shift-cell"><div class="shift-pill shift-morning"><span class="shift-type">Morning</span><span class="shift-time">8:00–16:00</span></div></td>
                    <td class="shift-cell"><div class="shift-pill shift-morning"><span class="shift-type">Morning</span><span class="shift-time">8:00–16:00</span></div></td>
                    <td class="shift-cell"><div class="shift-pill shift-afternoon"><span class="shift-type">Afternoon</span><span class="shift-time">16:00–00:00</span></div></td>
                    <td class="shift-cell"><div class="shift-pill shift-afternoon"><span class="shift-type">Afternoon</span><span class="shift-time">16:00–00:00</span></div></td>
                    <td class="shift-cell"><span class="shift-off">Off</span></td>
                    <td class="shift-cell"><div class="shift-pill shift-night"><span class="shift-type">Night</span><span class="shift-time">00:00–8:00</span></div></td>
                    <td class="shift-cell"><div class="shift-pill shift-night"><span class="shift-type">Night</span><span class="shift-time">00:00–8:00</span></div></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Summary Cards -->
    <div class="ws-summary">
        <div class="ws-sum-card">
            <div class="ws-sum-label">Total Shifts</div>
            <div class="ws-sum-val total">28</div>
        </div>
        <div class="ws-sum-card">
            <div class="ws-sum-label">Morning Shifts</div>
            <div class="ws-sum-val morning">12</div>
        </div>
        <div class="ws-sum-card">
            <div class="ws-sum-label">Afternoon Shifts</div>
            <div class="ws-sum-val afternoon">8</div>
        </div>
        <div class="ws-sum-card">
            <div class="ws-sum-label">Night Shifts</div>
            <div class="ws-sum-val night">5</div>
        </div>
    </div>

</div>

<script>
    // Week navigation
    const weeks = [
        'Week of Apr 27, 2026',
        'Week of May 4, 2026',
        'Week of May 11, 2026',
        'Week of May 18, 2026',
    ];
    let currentWeek = 1;

    function changeWeek(dir) {
        currentWeek = Math.max(0, Math.min(weeks.length - 1, currentWeek + dir));
        document.getElementById('weekLabel').textContent = weeks[currentWeek];
    }

    // Department filter
    function filterDept() {
        const dept  = document.getElementById('deptFilter').value;
        const rows  = document.querySelectorAll('#scheduleTable tbody tr');
        rows.forEach(row => {
            const rowDept = row.getAttribute('data-dept');
            row.style.display = (dept === '' || rowDept === dept) ? '' : 'none';
        });
    }
</script>

@endsection
