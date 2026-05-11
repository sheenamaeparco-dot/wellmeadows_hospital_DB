<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            background: #671a1a;
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

            <a href="#">Patient Management</a>

            <a href="#">Staff & Department</a>

            <a href="#">Ward & Bed</a>

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
            <i class="fas fa-calendar-day"></i> <!-- Calendar Icon -->
            <h3>Today's Appointment</h3>
            <h1>0</h1>
        </div>

        <div class="card">
            <i class="fas fa-users"></i> <!-- Users Icon -->
            <h3>Total Patients</h3>
            <h1>0</h1>
        </div>

        <div class="card">
             <i class="fas fa-bed"></i> <!-- Bed Icon -->
            <h3>Available Beds</h3>
            <h1>0</h1>
        </div>

    </div>

</body>
</html>