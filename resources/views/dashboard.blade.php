<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WellMeadows Dashboard</title>

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

        /* SIDEBAR */

       .sidebar{
            width:260px;
            background: rgba(107, 3, 3, 0.8);
            color:white;
            padding:25px;

            backdrop-filter: blur(10px);
        }

        .logo{
            font-size:30px;
            font-weight:bold;
            margin-bottom:40px;
        }

        .logo-img {
            width: 80px; /* Adjust the size to fit your design */
            height: auto;
            margin-bottom: 20px; /* Space between logo and text */
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

        /* SUBMENU DROPDOWN STYLES */
        .submenu {
            padding-left: 15px;
            margin-bottom: 10px;
            margin-top: -5px;
            display: block; /* Shown by default, but toggled by JS */
        }

        /* CSS class to hide the dropdown initially */
        .hidden {
            display: none;
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

        /* MAIN CONTENT */

        .main-content{
            flex:1;
            padding:30px;
            background-size:cover;
            background-position:center;
            background-repeat:no-repeat;

        }

        .topbar{
            background:white;
            padding:40px;
            border-radius:15px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .card{
            background:white;
            padding:30px;
            border-radius:15px;
            width: 298px;
            line-height:40px;
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

        .cards-container{
            display:flex;
            gap:20px;
            margin-top:20px;
            flex-wrap:wrap;
        }



    </style>
</head>

<body>

<div class="container">

    <!-- SIDEBAR -->

    <div class="sidebar">
        <img src="{{ asset('images/logo.png') }}" alt="WellMeadows Logo" class="logo-img">
        <div class="logo">
            WellMeadows
        </div>

        <div class="sidebar-menu">

            <a href="#">Dashboard</a>

            <a href="#">Patients</a>

            <a href="#">Staff & Department</a>

            <!-- Added id and click runner function -->
            <a href="javascript:void(0);" id="ward-menu-btn" style="margin-bottom: 5px;">Ward & Bed</a>
            
            <!-- Hidden by default with the 'hidden' class -->
            <div class="submenu hidden" id="ward-submenu">
                <!-- Laravel named route helpers check which sub-page is active -->
                <a href="{{ route('ward.reports') }}" class="{{ request()->routeIs('ward.reports') ? 'active-sub' : '' }}">Reports</a>
                <a href="{{ route('ward.bed-map') }}" class="{{ request()->routeIs('ward.bed-map') ? 'active-sub' : '' }}">Bed map</a>
                <a href="{{ route('ward.assign-bed') }}" class="{{ request()->routeIs('ward.assign-bed') ? 'active-sub' : '' }}">Assign bed</a>
                <a href="{{ route('ward.requisitions') }}" class="{{ request()->routeIs('ward.requisitions') ? 'active-sub' : '' }}">Requisitions</a>
            </div>

            <a href="#">Appointment & Treatment</a>

            <a href="#">Billing & Reports</a>

            <a href="#">Settings</a>

        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button class="logout-btn" type="submit">
                Logout
            </button>
        </form>

    </div>

    <!-- MAIN CONTENT -->

    <div class="main-content">

        <div class="topbar">

            <div>
                <h2>
                    Welcome, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} 👋
                </h2>
                
            </div>

        </div>

        <div class="cards-container">

        <div class="card">
            <h3>Today's Appointment</h3>
            <h1>0</h1>
        </div>

        <div class="card">
            <h3>Total Patients</h3>
            <h1>0</h1>
        </div>

        <div class="card">
            <h3>Available Beds</h3>
            <h1>0</h1>
        </div>

    </div>

</div>

<!-- Dropdown Menu Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var submenu = document.getElementById('ward-submenu');
        
        // Auto-detects if your current browser page url path is inside your ward routes
        // If it matches, it keeps the menu panel slid open across individual page refreshes
        if (window.location.pathname.includes('/ward-bed/')) {
            submenu.classList.remove('hidden');
        }

        // Toggles the submenu visibility configuration on click events
        document.getElementById('ward-menu-btn').addEventListener('click', function() {
            submenu.classList.toggle('hidden');
        });
    });
</script>

</body>
</html>
