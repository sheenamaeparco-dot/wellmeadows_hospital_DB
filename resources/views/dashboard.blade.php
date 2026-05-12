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
        /* --- Look for <style> and paste this inside --- */

/* Container block formatting for the nested items */
.submenu {
    background: rgba(0, 0, 0, 0.2); /* Dark block overlay container */
    border-radius: 12px;
    padding: 10px 5px;
    margin: 5px 0 15px 0;
    display: block; 
}

/* Individual list entries styled with bullet indent hints */
.submenu a {
    display: block;
    color: rgba(255, 255, 255, 0.9) !important;
    text-decoration: none;
    padding: 10px 20px !important;
    font-size: 14px;
    transition: 0.2s ease;
    border-radius: 8px;
    margin-bottom: 0px !important; 
}

/* Adds the clean bullet point dot from your picture */
.submenu a::before {
    content: "•";
    color: rgba(255, 255, 255, 0.6);
    display: inline-block;
    width: 15px;
    margin-left: -5px;
    font-size: 16px;
    vertical-align: middle;
}

.submenu a:hover, .submenu a.active-sub {
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff !important;
}

/* Spreads out text on the left and the arrow icon on the right */
.menu-trigger {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
}

/* Adds a smooth transition to your down arrow */
.arrow-icon {
    font-size: 12px;
    transition: transform 0.3s ease;
    opacity: 0.8;
}

/* Flips the arrow upside down when open */
.arrow-rotate {
    transform: rotate(180deg);
}

.hidden {
    display: none !important;
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
            <!-- Functional link back to dashboard -->
            <a href="{{ route('dashboard') }}" style="background: #5a1e1e;">Dashboard</a>

            <a href="#">Patients</a>

            <a href="#">Staff & Department</a>

            <!-- Ward & Bed Main Category Trigger with Arrow -->
            <a href="javascript:void(0);" id="ward-menu-btn" class="menu-trigger" style="margin-bottom: 5px;">
                <span>Ward & Bed</span>
                <span class="arrow-icon" id="ward-arrow">&#9662;</span>
            </a>
            
            <!-- Block-styled Submenu Container Element -->
            <div class="submenu hidden" id="ward-submenu">
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



<!-- Dropdown Menu Script -->
<script>
        document.addEventListener("DOMContentLoaded", function() {
        var submenu = document.getElementById('ward-submenu');
        var arrow = document.getElementById('ward-arrow');
        
        // Auto-detects if your path matches, keeps the container block open and arrow flipped
        if (window.location.pathname.includes('/ward-bed/')) {
            submenu.classList.remove('hidden');
            if (arrow) arrow.classList.add('arrow-rotate');
        }

        // Toggles display view states and spins the arrow icon on click events
        document.getElementById('ward-menu-btn').addEventListener('click', function() {
            submenu.classList.toggle('hidden');
            if (arrow) arrow.classList.toggle('arrow-rotate');
        });
    });

</script>

</body>
</html>
