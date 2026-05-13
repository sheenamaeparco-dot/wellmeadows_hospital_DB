@extends('layouts.app')

@section('content')
    <div class="topbar">
        <div>
            <h2>Welcome, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} 👋</h2>
        </div>
    </div>

    <div class="cards-container">
        <div class="card">
            <i class="fas fa-calendar-day"></i>
            <h3>Today's Appointment</h3>
            <h1>0</h1>
        </div>
        </div>
@endsection