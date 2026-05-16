@extends('layouts.app')

@section('content')

<style>
    .dw-wrap { padding: 10px 0; font-family: 'Poppins', sans-serif; }

    /* Header */
    .dw-header { margin-bottom: 24px; }
    .dw-header h2 { font-size: 22px; font-weight: 700; color: #1a1a1a; }
    .dw-header p  { font-size: 13px; color: #6b7280; margin-top: 3px; }

    /* Main layout */
    .dw-layout {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 20px;
        margin-bottom: 24px;
    }

    /* Shared card */
    .dw-card {
        background: white;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 4px rgba(0,0,0,.05);
        overflow: hidden;
    }
    .dw-card-header {
        padding: 16px 20px;
        font-size: 15px;
        font-weight: 700;
        color: #111827;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .dw-card-header i { color: #2d6a4f; font-size: 16px; }

    /* Department list */
    .dept-list { padding: 12px; }
    .dept-item {
        padding: 16px 18px;
        border-radius: 10px;
        border: 2px solid #e5e7eb;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all .2s;
    }
    .dept-item:last-child { margin-bottom: 0; }
    .dept-item:hover { border-color: #2d6a4f; background: #f0fdf4; }
    .dept-item.selected { border-color: #2d6a4f; background: #f0fdf4; }

    .dept-item-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    .dept-name { font-size: 14px; font-weight: 700; color: #111827; }
    .dept-count {
        font-size: 13px;
        font-weight: 600;
        color: #2d6a4f;
    }

    /* Progress bar */
    .dept-progress-bg {
        width: 100%;
        height: 7px;
        background: #e5e7eb;
        border-radius: 99px;
        overflow: hidden;
        margin-bottom: 6px;
    }
    .dept-progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #2d6a4f, #58936E);
        border-radius: 99px;
        transition: width .4s;
    }
    .dept-positions {
        font-size: 11.5px;
        color: #6b7280;
    }

    /* Staff members panel */
    .staff-panel { display: flex; flex-direction: column; }
    .staff-panel-body { padding: 12px; flex: 1; }

    .staff-member-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        margin-bottom: 8px;
        transition: background .15s;
        cursor: pointer;
    }
    .staff-member-item:last-child { margin-bottom: 0; }
    .staff-member-item:hover { background: #f0fdf4; }
    .staff-member-item.selected { background: #f0fdf4; border-color: #2d6a4f; }

    .staff-checkbox {
        width: 18px; height: 18px;
        border: 2px solid #d1d5db;
        border-radius: 4px;
        flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        transition: all .15s;
        cursor: pointer;
    }
    .staff-checkbox.checked {
        background: #2d6a4f;
        border-color: #2d6a4f;
        color: white;
        font-size: 11px;
    }

    .staff-info { flex: 1; }
    .staff-info-name { font-size: 13.5px; font-weight: 600; color: #111827; }
    .staff-info-meta { display: flex; gap: 6px; margin-top: 3px; align-items: center; }

    .role-badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 99px;
        font-size: 10.5px;
        font-weight: 600;
    }
    .role-doctor { background: #dbeafe; color: #1d4ed8; }
    .role-nurse  { background: #d1fae5; color: #065f46; }
    .role-admin  { background: #fef3c7; color: #92400e; }
    .staff-current-dept { font-size: 11px; color: #6b7280; }

    /* Assign button */
    .btn-assign {
        width: calc(100% - 24px);
        margin: 12px;
        padding: 12px;
        background: #2d6a4f;
        color: white;
        border: none;
        border-radius: 10px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .btn-assign:hover { background: #1b4332; }
    .btn-assign:disabled {
        background: #d1d5db;
        color: #9ca3af;
        cursor: not-allowed;
    }

    /* Assignments table */
    .dw-table {
        width: 100%;
        border-collapse: collapse;
    }
    .dw-table thead th {
        padding: 12px 20px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .07em;
        text-transform: uppercase;
        color: #9ca3af;
        text-align: left;
        background: #f9fafb;
        border-bottom: 1px solid #f3f4f6;
    }
    .dw-table tbody tr {
        border-bottom: 1px solid #f3f4f6;
        transition: background .12s;
    }
    .dw-table tbody tr:last-child { border-bottom: none; }
    .dw-table tbody tr:hover { background: #f0fdf4; }
    .dw-table tbody td {
        padding: 14px 20px;
        font-size: 13.5px;
        color: #374151;
        font-family: 'Poppins', sans-serif;
    }
    .dw-table tbody td.td-dept { font-weight: 600; color: #111827; }
    .dw-table tbody td.td-date { color: #6b7280; font-size: 12.5px; }
</style>

<div class="dw-wrap">

    <!-- Header -->
    <div class="dw-header">
        <h2>Departments & Wards</h2>
        <p>Assign staff members to departments and wards</p>
    </div>

    <!-- Top layout: Departments + Staff Members -->
    <div class="dw-layout">

        <!-- LEFT: Departments -->
        <div class="dw-card">
            <div class="dw-card-header">
                <i class="fas fa-hospital"></i> Departments
            </div>
            <div class="dept-list">

                <div class="dept-item selected" onclick="selectDept(this, 'Cardiology')">
                    <div class="dept-item-top">
                        <span class="dept-name">Cardiology</span>
                        <span class="dept-count">22/30</span>
                    </div>
                    <div class="dept-progress-bg">
                        <div class="dept-progress-fill" style="width:73%"></div>
                    </div>
                    <div class="dept-positions">8 positions available</div>
                </div>

                <div class="dept-item" onclick="selectDept(this, 'Emergency')">
                    <div class="dept-item-top">
                        <span class="dept-name">Emergency</span>
                        <span class="dept-count">28/35</span>
                    </div>
                    <div class="dept-progress-bg">
                        <div class="dept-progress-fill" style="width:80%"></div>
                    </div>
                    <div class="dept-positions">7 positions available</div>
                </div>

                <div class="dept-item" onclick="selectDept(this, 'Neurology')">
                    <div class="dept-item-top">
                        <span class="dept-name">Neurology</span>
                        <span class="dept-count">18/25</span>
                    </div>
                    <div class="dept-progress-bg">
                        <div class="dept-progress-fill" style="width:72%"></div>
                    </div>
                    <div class="dept-positions">7 positions available</div>
                </div>

                <div class="dept-item" onclick="selectDept(this, 'Pediatrics')">
                    <div class="dept-item-top">
                        <span class="dept-name">Pediatrics</span>
                        <span class="dept-count">25/30</span>
                    </div>
                    <div class="dept-progress-bg">
                        <div class="dept-progress-fill" style="width:83%"></div>
                    </div>
                    <div class="dept-positions">5 positions available</div>
                </div>

                <div class="dept-item" onclick="selectDept(this, 'Surgery')">
                    <div class="dept-item-top">
                        <span class="dept-name">Surgery</span>
                        <span class="dept-count">31/35</span>
                    </div>
                    <div class="dept-progress-bg">
                        <div class="dept-progress-fill" style="width:89%"></div>
                    </div>
                    <div class="dept-positions">4 positions available</div>
                </div>

                <div class="dept-item" onclick="selectDept(this, 'General Medicine')">
                    <div class="dept-item-top">
                        <span class="dept-name">General Medicine</span>
                        <span class="dept-count">35/40</span>
                    </div>
                    <div class="dept-progress-bg">
                        <div class="dept-progress-fill" style="width:88%"></div>
                    </div>
                    <div class="dept-positions">5 positions available</div>
                </div>

            </div>
        </div>

        <!-- RIGHT: Staff Members -->
        <div class="dw-card staff-panel">
            <div class="dw-card-header">
                <i class="fas fa-users"></i> Staff Members
            </div>
            <div class="staff-panel-body" id="staffList">

                <div class="staff-member-item" onclick="toggleStaffSelect(this)">
                    <div class="staff-checkbox" id="chk-1"></div>
                    <div class="staff-info">
                        <div class="staff-info-name">Dr. Sarah Johnson</div>
                        <div class="staff-info-meta">
                            <span class="role-badge role-doctor">Doctor</span>
                            <span class="staff-current-dept">Current: Cardiology</span>
                        </div>
                    </div>
                </div>

                <div class="staff-member-item" onclick="toggleStaffSelect(this)">
                    <div class="staff-checkbox" id="chk-2"></div>
                    <div class="staff-info">
                        <div class="staff-info-name">Nurse Emily Chen</div>
                        <div class="staff-info-meta">
                            <span class="role-badge role-nurse">Nurse</span>
                            <span class="staff-current-dept">Current: Emergency</span>
                        </div>
                    </div>
                </div>

                <div class="staff-member-item" onclick="toggleStaffSelect(this)">
                    <div class="staff-checkbox" id="chk-3"></div>
                    <div class="staff-info">
                        <div class="staff-info-name">Dr. Michael Brown</div>
                        <div class="staff-info-meta">
                            <span class="role-badge role-doctor">Doctor</span>
                            <span class="staff-current-dept">Current: Neurology</span>
                        </div>
                    </div>
                </div>

                <div class="staff-member-item" onclick="toggleStaffSelect(this)">
                    <div class="staff-checkbox" id="chk-4"></div>
                    <div class="staff-info">
                        <div class="staff-info-name">Admin Jane Smith</div>
                        <div class="staff-info-meta">
                            <span class="role-badge role-admin">Administrative</span>
                            <span class="staff-current-dept">Current: HR</span>
                        </div>
                    </div>
                </div>

                <div class="staff-member-item" onclick="toggleStaffSelect(this)">
                    <div class="staff-checkbox" id="chk-5"></div>
                    <div class="staff-info">
                        <div class="staff-info-name">Nurse David Lee</div>
                        <div class="staff-info-meta">
                            <span class="role-badge role-nurse">Nurse</span>
                            <span class="staff-current-dept">Current: Pediatrics</span>
                        </div>
                    </div>
                </div>

                <div class="staff-member-item" onclick="toggleStaffSelect(this)">
                    <div class="staff-checkbox" id="chk-6"></div>
                    <div class="staff-info">
                        <div class="staff-info-name">Dr. Lisa Anderson</div>
                        <div class="staff-info-meta">
                            <span class="role-badge role-doctor">Doctor</span>
                            <span class="staff-current-dept">Current: Pediatrics</span>
                        </div>
                    </div>
                </div>

                <div class="staff-member-item" onclick="toggleStaffSelect(this)">
                    <div class="staff-checkbox" id="chk-7"></div>
                    <div class="staff-info">
                        <div class="staff-info-name">Nurse John Martinez</div>
                        <div class="staff-info-meta">
                            <span class="role-badge role-nurse">Nurse</span>
                            <span class="staff-current-dept">Current: Emergency</span>
                        </div>
                    </div>
                </div>

                <div class="staff-member-item" onclick="toggleStaffSelect(this)">
                    <div class="staff-checkbox" id="chk-8"></div>
                    <div class="staff-info">
                        <div class="staff-info-name">Dr. Amanda White</div>
                        <div class="staff-info-meta">
                            <span class="role-badge role-doctor">Doctor</span>
                            <span class="staff-current-dept">Current: Surgery</span>
                        </div>
                    </div>
                </div>

            </div>

            <button class="btn-assign" id="assignBtn" onclick="assignStaff()" disabled>
                <i class="fas fa-user-plus"></i>
                <span id="assignBtnText">Assign 0 Staff Members</span>
            </button>
        </div>

    </div>

    <!-- Current Department Assignments Table -->
    <div class="dw-card">
        <div class="dw-card-header">
            <i class="fas fa-list"></i> Current Department Assignments
        </div>
        <table class="dw-table">
            <thead>
                <tr>
                    <th>Department</th>
                    <th>Staff Member</th>
                    <th>Role</th>
                    <th>Assigned Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="td-dept">Cardiology</td>
                    <td>Dr. Sarah Johnson</td>
                    <td><span class="role-badge role-doctor">Doctor</span></td>
                    <td class="td-date">2026-04-15</td>
                </tr>
                <tr>
                    <td class="td-dept">Emergency</td>
                    <td>Nurse Emily Chen</td>
                    <td><span class="role-badge role-nurse">Nurse</span></td>
                    <td class="td-date">2026-04-15</td>
                </tr>
                <tr>
                    <td class="td-dept">Neurology</td>
                    <td>Dr. Michael Brown</td>
                    <td><span class="role-badge role-doctor">Doctor</span></td>
                    <td class="td-date">2026-04-15</td>
                </tr>
                <tr>
                    <td class="td-dept">HR</td>
                    <td>Admin Jane Smith</td>
                    <td><span class="role-badge role-admin">Administrative</span></td>
                    <td class="td-date">2026-04-15</td>
                </tr>
                <tr>
                    <td class="td-dept">Pediatrics</td>
                    <td>Nurse David Lee</td>
                    <td><span class="role-badge role-nurse">Nurse</span></td>
                    <td class="td-date">2026-04-15</td>
                </tr>
                <tr>
                    <td class="td-dept">Pediatrics</td>
                    <td>Dr. Lisa Anderson</td>
                    <td><span class="role-badge role-doctor">Doctor</span></td>
                    <td class="td-date">2026-04-15</td>
                </tr>
                <tr>
                    <td class="td-dept">Emergency</td>
                    <td>Nurse John Martinez</td>
                    <td><span class="role-badge role-nurse">Nurse</span></td>
                    <td class="td-date">2026-04-15</td>
                </tr>
                <tr>
                    <td class="td-dept">Surgery</td>
                    <td>Dr. Amanda White</td>
                    <td><span class="role-badge role-doctor">Doctor</span></td>
                    <td class="td-date">2026-04-15</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<script>
    let selectedDept = 'Cardiology';
    let selectedCount = 0;

    function selectDept(el, deptName) {
        document.querySelectorAll('.dept-item').forEach(d => d.classList.remove('selected'));
        el.classList.add('selected');
        selectedDept = deptName;
    }

    function toggleStaffSelect(el) {
        const checkbox = el.querySelector('.staff-checkbox');
        const isChecked = checkbox.classList.contains('checked');

        if (isChecked) {
            checkbox.classList.remove('checked');
            checkbox.innerHTML = '';
            el.classList.remove('selected');
            selectedCount--;
        } else {
            checkbox.classList.add('checked');
            checkbox.innerHTML = '<i class="fas fa-check"></i>';
            el.classList.add('selected');
            selectedCount++;
        }

        const btn = document.getElementById('assignBtn');
        const btnText = document.getElementById('assignBtnText');
        btnText.textContent = `Assign ${selectedCount} Staff Member${selectedCount !== 1 ? 's' : ''}`;
        btn.disabled = selectedCount === 0;
    }

    function assignStaff() {
        if (selectedCount === 0 || !selectedDept) return;
        alert(`${selectedCount} staff member(s) assigned to ${selectedDept}!`);

        // Reset checkboxes
        document.querySelectorAll('.staff-checkbox.checked').forEach(chk => {
            chk.classList.remove('checked');
            chk.innerHTML = '';
            chk.closest('.staff-member-item').classList.remove('selected');
        });
        selectedCount = 0;
        document.getElementById('assignBtnText').textContent = 'Assign 0 Staff Members';
        document.getElementById('assignBtn').disabled = true;
    }
</script>

@endsection
