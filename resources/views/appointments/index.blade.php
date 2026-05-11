@extends('layouts.app') @section('content')
<div class="module-container">
    <div class="module-header">
        <h1>Appointment & Treatment Management</h1>
        <button class="btn-primary">+ Schedule New Appointment</button>
    </div>

    <div class="stats-row">
        <div class="mini-card">Today's Appointments: 0</div>
        <div class="mini-card">Pending Treatments: 0</div>
    </div>

    <div class="main-card">
        <h3>Current Appointments</h3>
        <table class="wellmeadows-table">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Doctor/Nurse</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6" style="text-align: center;">No appointments found.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection