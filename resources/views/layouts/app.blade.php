<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WellMeadows Hospital</title>

    <style>
        /* All your CSS from the dashboard goes here */
        * { margin:0; padding:0; box-sizing:border-box; font-family: Arial, sans-serif; }
        body { background:#f4f6f9; }
        .container { display:flex; min-height:100vh; }
        .sidebar { width:280px; background: #2D533E; color:white; padding:15px 10px; backdrop-filter: blur(10px); }
        .brand-container { display: flex; align-items: center; gap: 3px; margin-bottom: 20px; width: 100%; }
        .logo-img { width: 70px; height: 85px; object-fit: cover; transform: scale(1.5); }
        .sidebar .logo { font-size: 23px; font-weight: 700; font-family:'Poppins', sans-serif; color: white; white-space: nowrap; }
        .sidebar-menu a { display:block; color:white; text-decoration:none; padding:15px; border-radius:10px; margin-bottom:10px; transition:0.3s; font-family:'Poppins', sans-serif; font-size:15px; font-weight:500; }
        .sidebar-menu a:hover { background: #58936E; }
        .main-content { flex:1; padding:30px; }
        .logout-btn { width:90%; padding:10px; border:none; border-radius:10px; background: #58936E; color:white; font-size:16px; font-weight:bold; cursor:pointer; margin-top:50px; font-family: 'Poppins', sans-serif; }
        /* Add the rest of your card and topbar CSS here too */
        .topbar { background:white; padding:40px; border-radius:15px; display:flex; justify-content:space-between; align-items:center; margin-bottom:30px; }
        .card { background:white; padding:30px; border-radius:15px; width: 298px; line-height:40px; }
        .cards-container { display:flex; gap:20px; margin-top:20px; flex-wrap:wrap; }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="brand-container">
                <img src="{{ asset('images/logo-green.png') }}" alt="WellMeadows Logo" class="logo-img">
                <div class="logo">WellMeadows</div>
            </div>

            <div class="sidebar-menu">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="#">Patient Management</a>
                <a href="#">Staff & Department</a>
                <a href="#">Ward & Bed</a>
                <a href="{{ route('appointments.index') }}">Appointment & Treatment</a>
                <a href="#">Billing & Reports</a>
                <a href="#">Settings</a>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn" type="submit">Logout</button>
            </form>
        </div>

        <div class="main-content">
            @yield('content')
        </div>
    </div>
</body>
</html>