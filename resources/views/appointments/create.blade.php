@extends('layouts.app')

@section('content')
<div class="appointment-container">
    <div class="topbar mb-4">
        <div class="welcome-text">
            <h2>Schedule New Appointment</h2>
            <p>Fill in the details below to book a patient session.</p>
        </div>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary" style="border-radius: 8px;">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>

    <div class="form-card" style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-width: 800px;">
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Patient</label>
                    <select name="patient_id" class="form-select">
                        <option selected disabled>Select Patient</option>
                        <option value="1">Patient #1 (Mock)</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Clinic Number</label>
                    <input type="number" name="clinic_number" class="form-control" placeholder="Enter Clinic #">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Assigned Staff</label>
                    <select name="staff_number" class="form-select">
                        <option selected disabled>Select Doctor/Staff</option>
                        <option value="10">Dr. Michael Chen (Mock)</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Examination Room</label>
                    <select name="examination_room" class="form-select">
                        <option value="Room A">Room A</option>
                        <option value="Room B">Room B</option>
                        <option value="Room C">Room C</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Appointment Date</label>
                    <input type="date" name="appointment_date" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Appointment Time</label>
                    <input type="time" name="appointment_time" class="form-control">
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="reset" class="btn btn-light me-2">Clear Form</button>
                <button type="submit" class="btn" style="background: #2D533E; color: white; padding: 10px 30px; border-radius: 8px;">
                    Confirm Appointment
                </button>
            </div>
        </form>
    </div>
</div>
    @endsection