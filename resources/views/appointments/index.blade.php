@extends('layouts.app')
@section('content')

<!--HTML CODE FOR appointment and treatment -->
        <div class="appointment-container">
            <div class="topbar">
        <div class="welcome-text">
            <h2>Appointment Dashboard</h2>
            <p>Manage patient schedules and treatments</p>
        </div>

    <div class="user-profile">
        <span>(User Name)</span>
        </div>
    </div>

<div class="cards-container">

        <div class="card card-appointment">
            <h3>Today's Appointment</h3>
            <div class="card-value">0</div>
        </div>

    <div class="card card-pending">
        <h3>Pending Treatments</h3>
        <div class="card-value">0</div>
    </div>

    <div class="card card-completed">
        <h3>Completed Procedures</h3>
        <div class="card-value">0</div>
    </div>

</div>

    <div class="table-section">
        <h3>Recent Appointments</h3>
    </div>

    <div class="filter-row">
        <input type="text" class="form-control form-control-sm" placeholder="Search ID...">
        <button class="btn btn-sm">Filter</button>
    </div>
</div>

<div class="button-container">
    <form action = "/action.php" target = "_blank" method = "GET|POST">
       <a href="{{ route('appointments.create') }}" class="btn" style="background: #2D533E; color: white; border-radius: 8px; padding: 8px 15px; text-decoration: none;">
    <i class="fas fa-plus"></i> Add New Appointment
</a>
</div>

    <div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>PATIENT</th>
                <th>CLINIC</th>
                <th>STAFF</th>
                <th>DATE & TIME</th>
                <th>ROOM</th>
                <th>STATUS</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>2</td>
                <td>2026-05-10<br><small>09:00:00</small></td>
                <td>Room A</td>
                <td><span class="badge bg-success-subtle text-success">Completed</span></td>
            </tr>

            <tr>
                <td>3</td>
                <td>3</td>
                <td>3</td>
                <td>10</td>
                <td>2026-05-11<br><small>08:30:00</small></td>
                <td>Room C</td>
                <td><span class="badge bg-info-subtle text-info">Scheduled</span></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
    
<!--HTML CODE FOR appointment and treatment -->

    
<style>
/* All your CSS saimo module 4 sheen kay naa dari */
.button-container{
    display:flex;
    justify-content:flex-end;
}

.table{
    width:100%;
    border-collapse:collapse;
}
.cards-container {
    display: flex;            /* Turns on Flexbox */
    gap: 20px;               /* Adds space between the cards */
    margin-top: 20px;        /* Moves the whole group down from the header */
    justify-content: flex-start; /* Aligns them to the left */
}

.card {
    background: white;
    padding: 25px; /* More padding */
    border-radius: 15px;
    flex: 1;
    min-width: 200px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    display: flex;         /* Use flex inside the card */
    flex-direction: column; 
    align-items: center;    /* Centers the '0' */
    justify-content: center;
    text-align: center;
}

.card-value {
    font-size: 32px;        /* Make the '0' big and bold */
    font-weight: 700;
    color: #2D533E;         /* Your signature green */
    margin-top: 10px;
}

.table-section{
    padding:20px;
}

/* Appointment List table */
 .table-container{
    background:white;
    border-radius:15px;
    padding:20px;
    box-shadow:0 4px 6px rgba(0,0,0,0.05);
}

.table{
    width:100%;
    border-collapse:collapse;
}

.table th,
.table td{
    padding:15px;
    text-align:left;
}

.table thead th{
    font-size:12px;
    letter-spacing:1px;
    font-weight:600;
}

.table tbody tr{
    border-top:1px solid #f0f0f0;
}

.badge {
    padding: 8px 12px;
    border-radius: 6px;
    font-weight: 500;
}

/* Filter button sa appointment dashboard */
.appointment-container{
    width:100%;
}

.filter-row{
    display:flex;
    gap:5px;
    margin-top:15px;
}

.filter-row button{
    background:#2D533E;
    color:white;
    border:none;
    padding:4px 10px;
}


/* Custom background colors for soft badges */
.bg-success-subtle { background-color: #e8f5e9 !important; }
.bg-warning-subtle { background-color: #fff8e1 !important; }
.bg-info-subtle { background-color: #e3f2fd !important; }

</style>

@endsection
