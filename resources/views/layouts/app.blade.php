<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WellMeadows Hospital</title>

    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family: Arial, sans-serif; }
        body { background:#f4f6f9; }
        .container { display:flex; min-height:100vh; }
        .sidebar { width: 280px; background: #2D533E; color: white; padding: 15px 10px; backdrop-filter: blur(10px);  display: flex; flex-direction: column; height: 100vh; position: sticky; top: 0;  overflow-y: auto; }
        .brand-container { display: flex; align-items: center; gap: 3px; margin-bottom: 20px; width: 100%; }
        .logo-img { width: 70px; height: 85px; object-fit: cover; transform: scale(1.5); }
        .sidebar .logo { font-size: 23px; font-weight: 700; font-family:'Poppins', sans-serif; color: white; white-space: nowrap; }
        .sidebar-menu { flex:1; }
        .sidebar-menu a { display:flex; color:white; text-decoration:none; padding:20px; border-radius:10px; margin-bottom:10px; transition:0.3s; font-family:'Poppins', sans-serif; font-size:15px; font-weight:500; gap: 12px; }
        .sidebar-menu a i { width: 26px; min-width: 26px; text-align: center; font-size: 18px; }
        .sidebar-menu a:hover { background: #58936E; }
        .sidebar-menu a.active { background: #58936E; }
        .main-content { flex:1; padding:30px; }
        .logout-btn { width:90%; padding:10px; border:none; border-radius:10px; background:#58936E; color:white; font-size:16px; font-weight:bold; cursor:pointer; font-family:'Poppins', sans-serif; display:block; margin-left:auto; margin-right:auto; }
        .topbar { background:white; padding:40px; border-radius:15px; display:flex; justify-content:space-between; align-items:center; margin-bottom:30px; }
        .card { background:white; padding:30px; border-radius:15px; width: 298px; line-height:40px; }
        .cards-container { display:flex; gap:20px; margin-top:20px; flex-wrap:wrap; }

        .welcome-icon {
            color: #000000;
            margin-left: 8px;
            display: inline-block;
            vertical-align: middle;
            font-size: 0.9em;
            animation: simple-wave 2.5s infinite;
            transform-origin: bottom center;
        }
        @keyframes simple-wave {
            0%, 100% { transform: rotate(0deg); }
            20% { transform: rotate(15deg); }
            40% { transform: rotate(-10deg); }
            60% { transform: rotate(15deg); }
            80% { transform: rotate(-5deg); }
        }

        /* ── Staff & Department dropdown styles (Lovely)── */
        .staff-parent {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
            text-decoration: none;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 500;
            gap: 12px;
            cursor: pointer;
            transition: 0.3s;
        }
        .staff-parent:hover { background: #58936E; }
        .staff-parent.active { background: #58936E; }
        .staff-parent-left {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 500;
            white-space: nowrap;
        }
        .staff-parent-left i { width: 26px; min-width: 26px; text-align: center; font-size: 18px; }
        .staff-arrow { font-size: 12px; transition: transform 0.3s ease; opacity: 0.8; flex-shrink: 0; align-self: center; }
        .staff-arrow.rotated { transform: rotate(180deg); }

        .staff-submenu {
            display: none;
            flex-direction: column;
            padding-left: 20px;
            margin-bottom: 10px;
            margin-top: -4px;
        }
        .staff-submenu.open { display: flex; }
        .staff-submenu a {
            display: flex;
            align-items: center;
            padding: 12px 18px;
            border-radius: 10px;
            margin-bottom: 4px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 400;
            transition: 0.3s;
        }
        .staff-submenu a:hover { background: #58936E; color: white; }
        .staff-submenu a.active { background: #58936E; color: white; }
        /* ── Staff & Department dropdown styles (Lovely)── */

        /* Ward & Bed dropdown */
        .ward-parent {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
            text-decoration: none;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 500;
            gap: 12px;
            cursor: pointer;
            transition: 0.3s;
        }
        .ward-parent:hover { background: #58936E; }
        .ward-parent.active { background: #58936E; }
        .ward-parent-left {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 500;
            white-space: nowrap;
        }
        .ward-parent-left i { width: 26px; min-width: 26px; text-align: center; font-size: 18px; }
        .ward-arrow { font-size: 12px; transition: transform 0.3s ease; opacity: 0.8; flex-shrink: 0; align-self: center; }
        .ward-arrow.rotated { transform: rotate(180deg); }

        .ward-submenu {
            display: none;
            flex-direction: column;
            padding-left: 20px;
            margin-bottom: 10px;
            margin-top: -4px;
        }
        .ward-submenu.open { display: flex; }
        .ward-submenu a {
            display: flex;
            align-items: center;
            padding: 12px 18px;
            border-radius: 10px;
            margin-bottom: 4px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 400;
            transition: 0.3s;
        }
        .ward-submenu a:hover { background: #58936E; color: white; }
        .ward-submenu a.active { background: #58936E; color: white; }

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

                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i> Dashboard
                </a>

                <a href="{{ route('patients.index') }}"
                   class="{{ request()->routeIs('patients.*') ? 'active' : '' }}">
                    <i class="fas fa-user-injured"></i> Patient Management
                </a>

                <!-- Staff & Department with dropdown (Lovely) -->
                @if(request()->routeIs('staff.*'))
                    <a href="#"
                       class="staff-parent active"
                       onclick="event.preventDefault(); toggleStaff()">
                        <div class="staff-parent-left">
                            <i class="fas fa-users-cog"></i> Staff & Department
                        </div>
                        <i class="fas fa-chevron-down staff-arrow rotated" id="staff-arrow"></i>
                    </a>
                @else
                    <a href="{{ route('staff.index') }}"
                       class="staff-parent"
                       onclick="toggleStaff()">
                        <div class="staff-parent-left">
                            <i class="fas fa-users-cog"></i> Staff & Department
                        </div>
                        <i class="fas fa-chevron-down staff-arrow" id="staff-arrow"></i>
                    </a>
                @endif

                <div class="staff-submenu {{ request()->routeIs('staff.*') ? 'open' : '' }}"
                    id="staff-submenu">
                    <a href="{{ route('staff.index') }}"
                    class="{{ request()->routeIs('staff.index') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('staff.management') }}"
                    class="{{ request()->routeIs('staff.management') ? 'active' : '' }}">
                        Staff Management
                    </a>
                    <a href="{{ route('staff.departments') }}"
                    class="{{ request()->routeIs('staff.departments') ? 'active' : '' }}">
                        Departments & Wards
                    </a>
                    <a href="{{ route('staff.schedules') }}"
                    class="{{ request()->routeIs('staff.schedules') ? 'active' : '' }}">
                        Work Schedules
                    </a>
                </div>
                @if(request()->routeIs('ward.*'))
                    <a href="#"
                       class="ward-parent active"
                       onclick="event.preventDefault(); toggleWard()">
                        <div class="ward-parent-left">
                            <i class="fas fa-bed"></i> Ward & Bed
                        </div>
                        <i class="fas fa-chevron-down ward-arrow rotated" id="ward-arrow"></i>
                    </a>
                @else
                    <a href="{{ route('ward.index') }}"
                       class="ward-parent"
                       onclick="toggleWard()">
                        <div class="ward-parent-left">
                            <i class="fas fa-bed"></i> Ward & Bed
                        </div>
                        <i class="fas fa-chevron-down ward-arrow" id="ward-arrow"></i>
                    </a>
                @endif

                <div class="ward-submenu {{ request()->routeIs('ward.*') ? 'open' : '' }}"
                     id="ward-submenu">
                     <a href="{{ route('ward.index') }}"
                       class="{{ request()->routeIs('ward.dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('ward.bedmap') }}"
                       class="{{ request()->routeIs('ward.bedmap') ? 'active' : '' }}">
                        Bed Map
                    </a>
                    <a href="{{ route('ward.requisitions') }}"
                       class="{{ request()->routeIs('ward.requisitions') ? 'active' : '' }}">
                        Requisitions
                    </a>
                </div>
                <!-- Ward & Bed Management (Kelly) -->

                <!-- Appointment and Treatment (Sheena) -->
            <div class="sidebar-item">
                <div onclick="toggleAppointmentMenu()" style="cursor: pointer; display: flex; color: white; padding: 20px; border-radius: 10px; margin-bottom: 10px; font-family: 'Poppins', sans-serif; font-size: 15px; font-weight: 500; gap: 12px;" onmouseover="this.style.background='#58936E'" onmouseout="this.style.background='transparent'">
                <i class="fas fa-calendar-check"></i>
                <span>Appointment & Treatment</span>
                <i class="fas fa-chevron-down" style="font-size: 12px; margin-left: auto; margin-top: 5px;"></i>
            </div>

            <div id="appointmentMenu" style="display:none; padding-left: 20px;">
                <a href="{{ route('appointments.index') }}" style="display: block; color: white; text-decoration: none; padding: 10px 20px; font-size: 14px;">• View Dashboard</a>
                <a href="{{ route('appointments.create') }}" style="display: block; color: white; text-decoration: none; padding: 10px 20px; font-size: 14px;">• New Appointment</a>
            </div>
        </div>
            <!-- Appointment and Treatment (Sheena) -->

                <a href="{{ route('billings.index') }}"
                   class="{{ request()->routeIs('billings.*') ? 'active' : '' }}">
                    <i class="fas fa-file-invoice-dollar"></i> Billing & Reports
                </a>

            </div>

            <form method="POST" action="{{ route('logout') }}" style="text-align:center; padding:15px 0;">
                @csrf
                <button class="logout-btn" type="submit">Logout</button>
            </form>

        </div>

        <div class="main-content">
            @yield('content')
        </div>
    </div>
    <!-- Appointment and Treatment - Sheena (para sakoa sidebar) -->
<script>
    function toggleAppointmentMenu() {
        const menu = document.getElementById('appointmentMenu');

        if (menu.style.display === 'none') {
            menu.style.display = 'block';
        } else {
            menu.style.display = 'none';
        }
    }
    /* Appointment and Treatment- Sheena (para sakoa sidebar) */
</script>

    <script>
        function toggleStaff() {
            const menu  = document.getElementById('staff-submenu');
            const arrow = document.getElementById('staff-arrow');
            menu.classList.toggle('open');
            arrow.classList.toggle('rotated');
        }

        function toggleWard() {
            const menu  = document.getElementById('ward-submenu');
            const arrow = document.getElementById('ward-arrow');
            menu.classList.toggle('open');
            arrow.classList.toggle('rotated');
        }
    </script>
</body>
</html>
