@extends('layouts.app')

@section('content')

<style>
    .sm-wrap { padding: 10px 0; font-family: 'Poppins', sans-serif; }

    /* Header */
    .sm-header { margin-bottom: 24px; }
    .sm-header h2 { font-size: 22px; font-weight: 700; color: #1a1a1a; }
    .sm-header p  { font-size: 13px; color: #6b7280; margin-top: 3px; }

    /* Toolbar */
    .sm-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .sm-search-wrap {
        flex: 1;
        min-width: 200px;
        position: relative;
    }
    .sm-search-wrap i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 14px;
    }
    .sm-search {
        width: 100%;
        padding: 11px 14px 11px 40px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-family: 'Poppins', sans-serif;
        font-size: 13.5px;
        color: #374151;
        outline: none;
        transition: border .2s;
    }
    .sm-search:focus { border-color: #2d6a4f; }

    .sm-filter {
        padding: 11px 16px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-family: 'Poppins', sans-serif;
        font-size: 13.5px;
        color: #374151;
        background: white;
        outline: none;
        cursor: pointer;
    }

    .sm-btn-add {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 11px 20px;
        background: #2d6a4f;
        color: white;
        border: none;
        border-radius: 10px;
        font-family: 'Poppins', sans-serif;
        font-size: 13.5px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s;
        text-decoration: none;
        white-space: nowrap;
    }
    .sm-btn-add:hover { background: #1b4332; color: white; }

    /* Table card */
    .sm-card {
        background: white;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 4px rgba(0,0,0,.05);
        overflow: hidden;
    }
    .sm-table {
        width: 100%;
        border-collapse: collapse;
    }
    .sm-table thead th {
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
    .sm-table tbody tr {
        border-bottom: 1px solid #f3f4f6;
        transition: background .12s;
    }
    .sm-table tbody tr:last-child { border-bottom: none; }
    .sm-table tbody tr:hover { background: #f0fdf4; }
    .sm-table tbody td {
        padding: 15px 20px;
        font-size: 13.5px;
        color: #374151;
        font-family: 'Poppins', sans-serif;
    }
    .sm-name { font-weight: 600; color: #111827; }

    /* Role badges */
    .badge {
        display: inline-block;
        padding: 3px 12px;
        border-radius: 99px;
        font-size: 11.5px;
        font-weight: 600;
    }
    .badge-doctor { background: #dbeafe; color: #1d4ed8; }
    .badge-nurse  { background: #d1fae5; color: #065f46; }
    .badge-admin  { background: #fef3c7; color: #92400e; }

    /* Status badges */
    .status {
        display: inline-block;
        padding: 3px 12px;
        border-radius: 99px;
        font-size: 11.5px;
        font-weight: 600;
    }
    .status-active  { background: #d1fae5; color: #065f46; }
    .status-leave   { background: #fef3c7; color: #92400e; }
    .status-inactive{ background: #fee2e2; color: #991b1b; }

    /* Action buttons */
    .sm-actions { display: flex; gap: 8px; }
    .btn-edit, .btn-delete {
        width: 32px; height: 32px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        font-size: 13px;
        transition: background .2s;
    }
    .btn-edit   { background: #dbeafe; color: #1d4ed8; }
    .btn-edit:hover   { background: #bfdbfe; }
    .btn-delete { background: #fee2e2; color: #dc2626; }
    .btn-delete:hover { background: #fecaca; }

    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.45);
        z-index: 999;
        align-items: center;
        justify-content: center;
    }
    .modal-overlay.open { display: flex; }
    .modal {
        background: white;
        border-radius: 16px;
        padding: 32px;
        width: 100%;
        max-width: 640px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0,0,0,.2);
    }
    .modal-title {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 4px;
    }
    .modal-sub {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 24px;
    }
    .modal-section {
        font-size: 14px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 20px 0 12px;
        padding-bottom: 6px;
        border-bottom: 1px solid #f3f4f6;
    }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .form-group { display: flex; flex-direction: column; gap: 5px; }
    .form-group.full { grid-column: span 2; }
    .form-group label {
        font-size: 12px;
        font-weight: 600;
        color: #374151;
    }
    .form-group label span { color: #dc2626; }
    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 10px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        color: #374151;
        outline: none;
        transition: border .2s;
    }
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus { border-color: #2d6a4f; }
    .form-group textarea { resize: vertical; min-height: 80px; }

    .modal-footer {
        display: flex;
        gap: 12px;
        margin-top: 24px;
        justify-content: flex-end;
    }
    .btn-cancel {
        padding: 10px 22px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        background: white;
        font-family: 'Poppins', sans-serif;
        font-size: 13.5px;
        font-weight: 600;
        color: #374151;
        cursor: pointer;
        transition: background .2s;
    }
    .btn-cancel:hover { background: #f9fafb; }
    .btn-save {
        padding: 10px 22px;
        border: none;
        border-radius: 10px;
        background: #2d6a4f;
        color: white;
        font-family: 'Poppins', sans-serif;
        font-size: 13.5px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s;
    }
    .btn-save:hover { background: #1b4332; }
</style>

<div class="sm-wrap">

    <!-- Header -->
    <div class="sm-header">
        <h2>Staff Management</h2>
        <p>Manage all hospital staff members</p>
    </div>

    <!-- Toolbar -->
    <div class="sm-toolbar">
        <div class="sm-search-wrap">
            <i class="fas fa-search"></i>
            <input type="text" class="sm-search" placeholder="Search by name, email, or phone..."
                   id="searchInput" onkeyup="filterTable()">
        </div>
        <select class="sm-filter" id="roleFilter" onchange="filterTable()">
            <option value="">All Roles</option>
            <option value="Doctor">Doctor</option>
            <option value="Nurse">Nurse</option>
            <option value="Administrative">Administrative</option>
        </select>
        <button class="sm-btn-add" onclick="openModal()">
            <i class="fas fa-plus"></i> Add Staff
        </button>
    </div>

    <!-- Table -->
    <div class="sm-card">
        <table class="sm-table" id="staffTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Department</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="sm-name">Dr. Sarah Johnson</td>
                    <td><span class="badge badge-doctor">Doctor</span></td>
                    <td>Cardiology</td>
                    <td>555-0101<br><span style="color:#6b7280;font-size:12px">sarah.j@wellmeadows.com</span></td>
                    <td><span class="status status-active">Active</span></td>
                    <td>
                        <div class="sm-actions">
                            <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="sm-name">Nurse Emily Chen</td>
                    <td><span class="badge badge-nurse">Nurse</span></td>
                    <td>Emergency</td>
                    <td>555-0102<br><span style="color:#6b7280;font-size:12px">emily.c@wellmeadows.com</span></td>
                    <td><span class="status status-active">Active</span></td>
                    <td>
                        <div class="sm-actions">
                            <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="sm-name">Dr. Michael Brown</td>
                    <td><span class="badge badge-doctor">Doctor</span></td>
                    <td>Neurology</td>
                    <td>555-0103<br><span style="color:#6b7280;font-size:12px">michael.b@wellmeadows.com</span></td>
                    <td><span class="status status-active">Active</span></td>
                    <td>
                        <div class="sm-actions">
                            <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="sm-name">Admin Jane Smith</td>
                    <td><span class="badge badge-admin">Administrative</span></td>
                    <td>HR</td>
                    <td>555-0104<br><span style="color:#6b7280;font-size:12px">jane.s@wellmeadows.com</span></td>
                    <td><span class="status status-active">Active</span></td>
                    <td>
                        <div class="sm-actions">
                            <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="sm-name">Nurse David Lee</td>
                    <td><span class="badge badge-nurse">Nurse</span></td>
                    <td>Pediatrics</td>
                    <td>555-0105<br><span style="color:#6b7280;font-size:12px">david.l@wellmeadows.com</span></td>
                    <td><span class="status status-leave">On Leave</span></td>
                    <td>
                        <div class="sm-actions">
                            <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="sm-name">Dr. Amanda White</td>
                    <td><span class="badge badge-doctor">Doctor</span></td>
                    <td>Surgery</td>
                    <td>555-0106<br><span style="color:#6b7280;font-size:12px">amanda.w@wellmeadows.com</span></td>
                    <td><span class="status status-active">Active</span></td>
                    <td>
                        <div class="sm-actions">
                            <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="sm-name">Nurse John Martinez</td>
                    <td><span class="badge badge-nurse">Nurse</span></td>
                    <td>Emergency</td>
                    <td>555-0107<br><span style="color:#6b7280;font-size:12px">john.m@wellmeadows.com</span></td>
                    <td><span class="status status-active">Active</span></td>
                    <td>
                        <div class="sm-actions">
                            <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="sm-name">Dr. Lisa Anderson</td>
                    <td><span class="badge badge-doctor">Doctor</span></td>
                    <td>Pediatrics</td>
                    <td>555-0108<br><span style="color:#6b7280;font-size:12px">lisa.a@wellmeadows.com</span></td>
                    <td><span class="status status-active">Active</span></td>
                    <td>
                        <div class="sm-actions">
                            <button class="btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Staff Modal -->
<div class="modal-overlay" id="modalOverlay">
    <div class="modal">
        <div class="modal-title">Add New Staff Member</div>
        <div class="modal-sub">Fill in the details to add a new staff member</div>

        <form method="POST" action="#">
            @csrf

            <div class="modal-section">Personal Information</div>
            <div class="form-grid">
                <div class="form-group">
                    <label>First Name <span>*</span></label>
                    <input type="text" name="first_name" placeholder="Enter first name" required>
                </div>
                <div class="form-group">
                    <label>Last Name <span>*</span></label>
                    <input type="text" name="last_name" placeholder="Enter last name" required>
                </div>
                <div class="form-group">
                    <label>Date of Birth <span>*</span></label>
                    <input type="date" name="dob" required>
                </div>
                <div class="form-group">
                    <label>Phone Number <span>*</span></label>
                    <input type="text" name="phone" placeholder="555-0123" required>
                </div>
                <div class="form-group">
                    <label>Email <span>*</span></label>
                    <input type="email" name="email" placeholder="email@wellmeadows.com" required>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" placeholder="Street address">
                </div>
            </div>

            <div class="modal-section">Employment Information</div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Role <span>*</span></label>
                    <select name="role" required>
                        <option value="">Select role</option>
                        <option>Doctor</option>
                        <option>Nurse</option>
                        <option>Administrative</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Department <span>*</span></label>
                    <select name="department" required>
                        <option value="">Select department</option>
                        <option>Emergency</option>
                        <option>Cardiology</option>
                        <option>Neurology</option>
                        <option>Pediatrics</option>
                        <option>Surgery</option>
                        <option>General Medicine</option>
                        <option>HR</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Position</label>
                    <input type="text" name="position" placeholder="e.g., Senior Surgeon, Head Nurse">
                </div>
                <div class="form-group">
                    <label>Hire Date <span>*</span></label>
                    <input type="date" name="hire_date" required>
                </div>
                <div class="form-group">
                    <label>Salary</label>
                    <input type="number" name="salary" placeholder="Annual salary">
                </div>
                <div class="form-group">
                    <label>Status <span>*</span></label>
                    <select name="status" required>
                        <option value="Active">Active</option>
                        <option value="On Leave">On Leave</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="modal-section">Qualifications</div>
            <div class="form-grid">
                <div class="form-group full">
                    <label>Qualifications & Certifications</label>
                    <textarea name="qualifications" placeholder="List qualifications, degrees, certifications..."></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save" style="margin-right:6px"></i> Add Staff
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modalOverlay').classList.add('open');
    }
    function closeModal() {
        document.getElementById('modalOverlay').classList.remove('open');
    }
    // Close modal if clicking outside
    document.getElementById('modalOverlay').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    // Search + filter
    function filterTable() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const role   = document.getElementById('roleFilter').value.toLowerCase();
        const rows   = document.querySelectorAll('#staffTable tbody tr');

        rows.forEach(row => {
            const text    = row.innerText.toLowerCase();
            const roleTxt = row.querySelector('.badge') ? row.querySelector('.badge').innerText.toLowerCase() : '';
            const matchSearch = text.includes(search);
            const matchRole   = role === '' || roleTxt.includes(role);
            row.style.display = matchSearch && matchRole ? '' : 'none';
        });
    }
</script>

@endsection
