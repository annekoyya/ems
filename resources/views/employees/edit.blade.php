<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Edit Profile - Blue Lotus</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: #f5f5f5; }
        .container { display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar { width: 230px; background-color: #0F2453; padding: 20px 0; position: fixed; height: 100vh; }
        .logo { display: flex; align-items: center; padding: 0 20px 30px; gap: 10px; }
        .logo-text { color: white; font-size: 14px; font-weight: 600; line-height: 1.3; }
        .menu { list-style: none; }
        .menu-item { padding: 12px 20px; color: white; display: flex; align-items: center; gap: 12px; cursor: pointer; transition: all 0.3s; font-size: 14px; text-decoration: none; }
        .menu-item:hover { background-color: rgba(255, 255, 255, 0.1); }
        .menu-item.active { background-color: #FAEC1D; color: #0F2453; font-weight: 600; border-radius: 5px; margin: 0 10px; padding-left: 10px; }
        .menu-icon { width: 20px; height: 20px; }

        /* Main Content */
        .main-content { margin-left: 230px; flex: 1; padding: 20px 30px; }
        .header { background-color: white; padding: 15px 25px; display: flex; justify-content: space-between; align-items: center; border-radius: 8px; margin-bottom: 25px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .header-left { display: flex; align-items: center; gap: 20px; }
        .back-btn { background: none; border: none; color: #0F2453; cursor: pointer; display: flex; align-items: center; font-size: 24px; }
        .header h1 { color: #0F2453; font-size: 20px; font-weight: 600; }
        .user-info { display: flex; align-items: center; gap: 10px; }
        .user-avatar { width: 35px; height: 35px; border-radius: 50%; background-color: #FAEC1D; display: flex; align-items: center; justify-content: center; font-weight: 600; color: #0F2453; }
        .user-details { text-align: right; }
        .user-name { font-size: 13px; font-weight: 600; color: #0F2453; }
        .user-role { font-size: 11px; color: #666; }

        /* Form Container */
        .form-container { background-color: white; border-radius: 8px; padding: 30px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .form-section { margin-bottom: 30px; padding-bottom: 30px; border-bottom: 1px solid #e9ecef; }
        .form-section:last-child { border-bottom: none; }
        .section-title { font-size: 16px; font-weight: 600; color: #0F2453; margin-bottom: 20px; }
        .form-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 20px; }
        .form-row.two-cols { grid-template-columns: repeat(2, 1fr); }
        .form-row.full { grid-template-columns: 1fr; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: #666; margin-bottom: 8px; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus { outline: none; border-color: #45AEE4; }

        .btn-save { background-color: #45AEE4; color: white; padding: 10px 30px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; font-weight: 500; float: right; }
        .btn-save:hover { background-color: #3a9cd1; }
        .logout-btn { background: none; border: none; color: #0F2453; cursor: pointer; padding: 5px 10px; font-size: 20px; display: flex; align-items: center; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <svg width="35" height="35" viewBox="0 0 40 40" fill="none">
                    <circle cx="20" cy="20" r="18" fill="#45AEE4"/>
                    <path d="M20 10 L25 18 L20 15 L15 18 Z" fill="white"/>
                    <ellipse cx="20" cy="25" rx="8" ry="3" fill="white"/>
                </svg>
                <div class="logo-text">BLUE LOTUS<br>HOTEL</div>
            </div>
            
            <ul class="menu">
                <li><a href="{{ route('employees.index') }}" class="menu-item">
                    <svg class="menu-icon" viewBox="0 0 20 20" fill="currentColor">
                        <rect x="2" y="2" width="7" height="7" rx="1"/>
                        <rect x="11" y="2" width="7" height="7" rx="1"/>
                        <rect x="2" y="11" width="7" height="7" rx="1"/>
                        <rect x="11" y="11" width="7" height="7" rx="1"/>
                    </svg>
                    Dashboard
                </a></li>
                <li><a href="{{ route('employees.index') }}" class="menu-item active">
                    <svg class="menu-icon" viewBox="0 0 20 20" fill="currentColor">
                        <circle cx="10" cy="6" r="3"/>
                        <path d="M4 18c0-3.314 2.686-6 6-6s6 2.686 6 6"/>
                    </svg>
                    Employee
                </a></li>
                <li><a href="#" class="menu-item">
                    <svg class="menu-icon" viewBox="0 0 20 20" fill="currentColor">
                        <rect x="3" y="3" width="14" height="14" rx="2" fill="none" stroke="currentColor" stroke-width="2"/>
                        <line x1="3" y1="8" x2="17" y2="8" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Attendance
                </a></li>
                <li><a href="#" class="menu-item">
                    <svg class="menu-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M3 5h14M3 10h14M3 15h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Payroll
                </a></li>
                <li><a href="#" class="menu-item">
                    <svg class="menu-icon" viewBox="0 0 20 20" fill="currentColor">
                        <circle cx="10" cy="10" r="7" fill="none" stroke="currentColor" stroke-width="2"/>
                        <path d="M10 6v4l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Performance
                </a></li>
                <li><a href="#" class="menu-item">
                    <svg class="menu-icon" viewBox="0 0 20 20" fill="currentColor">
                        <rect x="4" y="4" width="12" height="12" rx="2" fill="none" stroke="currentColor" stroke-width="2"/>
                        <circle cx="10" cy="10" r="2"/>
                    </svg>
                    Recruitment
                </a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <div class="header-left">
                    <button class="back-btn" onclick="window.location.href='{{ route('employees.index') }}'">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <h1>Employee Management / Edit Profile</h1>
                </div>
                <div class="user-info">
                    <div class="user-details">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-role">Human Resources Staff</div>
                    </div>
                    <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn" title="Logout">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M13 3h3a2 2 0 012 2v10a2 2 0 01-2 2h-3M8 14l-5-4 5-4M3 10h11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <form method="POST" action="{{ route('employees.update', $employee) }}" class="form-container">
                @csrf
                @method('PUT')
                
                <button type="submit" class="btn-save">Save Employee</button>
                
                <!-- Personal Details -->
                <div class="form-section">
                    <div class="section-title">Personal Details</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" name="middle_name" value="{{ old('middle_name', $employee->middle_name) }}">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Name Extension</label>
                            <input type="text" name="name_extension" value="{{ old('name_extension', $employee->name_extension) }}">
                        </div>
                    </div>
                    <div class="form-row two-cols">
                        <div class="form-group">
                            <label>Employee ID</label>
                            <input type="text" value="{{ str_pad($employee->id, 6, '0', STR_PAD_LEFT) }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $employee->date_of_birth) }}">
                        </div>
                    </div>
                </div>

                <!-- Contact Details -->
                <div class="form-section">
                    <div class="section-title">Contact Details</div>
                    <div class="form-row full">
                        <div class="form-group">
                            <label>Home Address</label>
                            <textarea name="home_address" rows="2">{{ old('home_address', $employee->home_address) }}</textarea>
                        </div>
                    </div>
                    <div class="form-row two-cols">
                        <div class="form-group">
                            <label>Emergency Contact Name</label>
                            <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name', $employee->emergency_contact_name) }}">
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $employee->email) }}" required>
                        </div>
                    </div>
                    <div class="form-row two-cols">
                        <div class="form-group">
                            <label>Emergency Contact Number</label>
                            <input type="text" name="emergency_contact_number" value="{{ old('emergency_contact_number', $employee->emergency_contact_number) }}">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone_number" value="{{ old('phone_number', $employee->phone_number) }}">
                        </div>
                        