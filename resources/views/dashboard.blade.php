<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
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
            width:280px;
            background: #2D533E;
            color:white;
            padding:15px 10px;


            backdrop-filter: blur(10px);
        }

        
        /* Container to hold both logo and text side-by-side */
    .brand-container {
        display: flex;
        align-items: center; /* Vertically centers the logo with the text */
        gap: 3px;           /* Space between the logo and the text */
        margin-bottom: 20px;
        width: 100%;
        overflow: visible;
    }

        .logo-img {
            width: 70px;         /* Reduced size to fit better next to text */
            height: 85px;
            object-fit: cover;
            transform: scale(1.5); 
        }


        .sidebar .logo {
            font-size: 23px;         /* Dropped slightly from 30px so there is room for the 60px logo */
            font-weight: 700;
            font-family:'Poppins', sans-serif;
            color: white;
            margin-bottom: 0;
            white-space: nowrap; 
        }
        .sidebar-menu a{
            display:block;
            color:white;
            text-decoration:none;
            padding:15px;
            border-radius:10px;
            margin-bottom:10px;
            transition:0.3s;

            font-family:'Poppins', sans-serif;
            font-size:15px;
            font-weight:500;
            letter-spacing:0.2px;
        }

        .sidebar-menu a:hover{
            background: #58936E ;
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
            background: #58936E;
            color:white;
            font-size:16px;
            font-weight:bold;
            cursor:pointer;
            margin-top:50px;
            font-family: 'Poppins', sans-serif;

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
    <!-- Wrap both in this new container -->
        <div class="brand-container">
            <img src="{{ asset('images/logo-green.png') }}" alt="WellMeadows Logo" class="logo-img">
            <div class="logo">WellMeadows</div>
        </div>

        <div class="sidebar-menu">

            <a href="#">Dashboard</a>

            <a href="#">Patient Management</a>

            <a href="#">Staff & Department</a>

            <a href="#">Ward & Bed</a>

            <a href="{{ route('appointments.index')}}" class="sidebar-link">
                Appointment & Treatment
            </a>

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