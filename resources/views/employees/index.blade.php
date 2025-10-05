<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management - Blue Lotus</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 230px;
            background-color: #0F2453;
            padding: 20px 0;
            position: fixed;
            height: 100vh;
        }

        .logo {
            display: flex;
            align-items: center;
            padding: 0 20px 30px;
            gap: 10px;
        }

        .logo img {
            width: 35px;
            height: 35px;
        }

        .logo-text {
            color: white;
            font-size: 14px;
            font-weight: 600;
            line-height: 1.3;
        }

        .menu {
            list-style: none;
        }

        .menu-item {
            padding: 12px 20px;
            color: white;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            text-decoration: none;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .menu-item.active {
            background-color: #FAEC1D;
            color: #0F2453;
            font-weight: 600;
            border-radius: 5px;
            margin: 0 10px;
            padding-left: 10px;
        }

        .menu-icon {
            width: 20px;
            height: 20px;
        }

        /* Main Content */
        .main-content {
            margin-left: 230px;
            flex: 1;
            padding: 20px 30px;
        }

        .header {
            background-color: white;
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px;
            margin-bottom: 25px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .header h1 {
            color: #0F2453;
            font-size: 24px;
            font-weight: 600;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #FAEC1D;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #0F2453;
        }

        .user-details {
            text-align: right;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: #0F2453;
        }

        .user-role {
            font-size: 11px;
            color: #666;
        }

        /* Controls */
        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-filter {
            display: flex;
            gap: 10px;
        }

        .search-box {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            width: 250px;
        }

        .filter-btn {
            padding: 10px 15px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .filter-btn:hover {
            background-color: #f0f0f0;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #45AEE4;
            color: white;
        }

        .btn-primary:hover {
            background-color: #3a9cd1;
        }

        .btn-secondary {
            background-color: #0F2453;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #1a3570;
        }

        /* Table */
        .table-container {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f8f9fa;
        }

        th {
            padding: 15px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: #0F2453;
            border-bottom: 2px solid #e9ecef;
            cursor: pointer;
        }

        td {
            padding: 15px;
            font-size: 13px;
            color: #333;
            border-bottom: 1px solid #f0f0f0;
        }

        tbody tr:hover {
            background-color: #f8f9fa;
        }

        .action-icons {
            display: flex;
            gap: 10px;
        }

        .icon-btn {
            width: 28px;
            height: 28px;
            border: none;
            background-color: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .icon-btn:hover {
            background-color: #f0f0f0;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: white;
        }

        .pagination-info {
            font-size: 13px;
            color: #666;
        }

        .pagination-controls {
            display: flex;
            gap: 5px;
        }

        .page-btn {
            width: 32px;
            height: 32px;
            border: 1px solid #ddd;
            background-color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.3s;
        }

        .page-btn:hover {
            background-color: #f0f0f0;
        }

        .page-btn.active {
            background-color: #45AEE4;
            color: white;
            border-color: #45AEE4;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background-color: white;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background-color: #0F2453;
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 18px;
            font-weight: 600;
        }

        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-body {
            padding: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .form-actions .btn {
            flex: 1;
            justify-content: center;
        }

        .btn-cancel {
            background-color: #f0f0f0;
            color: #333;
        }

        .btn-cancel:hover {
            background-color: #e0e0e0;
        }

        .success-message {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 12px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .logout-btn {
            background: none;
            border: none;
            color: #0F2453;
            cursor: pointer;
            padding: 5px 10px;
            font-size: 20px;
            display: flex;
            align-items: center;
        }
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
                <li>
                    <a href="{{ route('employees.index') }}" class="menu-item">
                        <svg class="menu-icon" viewBox="0 0 20 20" fill="currentColor">
                            <rect x="2" y="2" width="7" height="7" rx="1"/>
                            <rect x="11" y="2" width="7" height="7" rx="1"/>
                            <rect x="2" y="11" width="7" height="7" rx="1"/>
                            <rect x="11" y="11" width="7" height="7" rx="1"/>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('employees.index') }}" class="menu-item active">
                        <svg class="menu-icon" viewBox="0 0 20 20" fill="currentColor">
                            <circle cx="10" cy="6" r="3"/>
                            <path d="M4 18c0-3.314 2.686-6 6-6s6 2.686 6 6"/>
                        </svg>
                        Employee
                    </a>
                </li>
                <li>
                    <a href="{{ route('newhires.index') }}" class="menu-item">
                        <svg class="menu-icon" viewBox="0 0 20 20" fill="currentColor">
                            <circle cx="10" cy="7" r="3"/>
                            <path d="M16 10v8M12 14h8M4 18c0-3 2.5-5.5 6-5.5" stroke="currentColor" fill="none" stroke-width="1.5"/>
                        </svg>
                        New Hire
                    </a>
                </li>
                <li>
                    <a href="{{ route('terminations.index') }}" class="menu-item">
                        <svg class="menu-icon" viewBox="0 0 20 20" fill="currentColor">
                            <rect x="3" y="5" width="14" height="12" rx="1" fill="none" stroke="currentColor" stroke-width="1.5"/>
                            <line x1="7" y1="9" x2="13" y2="9" stroke="currentColor" stroke-width="1.5"/>
                            <line x1="7" y1="12" x2="13" y2="12" stroke="currentColor" stroke-width="1.5"/>
                        </svg>
                        Termination
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <svg class="menu-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 5h14M3 10h14M3 15h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        Payroll
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <svg class="menu-icon" viewBox="0 0 20 20" fill="currentColor">
                            <circle cx="10" cy="10" r="7" fill="none" stroke="currentColor" stroke-width="2"/>
                            <path d="M10 6v4l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        Performance
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <svg class="menu-icon" viewBox="0 0 20 20" fill="currentColor">
                            <rect x="4" y="4" width="12" height="12" rx="2" fill="none" stroke="currentColor" stroke-width="2"/>
                            <circle cx="10" cy="10" r="2"/>
                        </svg>
                        Recruitment
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Employee Management</h1>
                <div class="header-actions">
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
            </div>

            @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
            @endif

            <div class="controls">
                <form method="GET" action="{{ route('employees.index') }}" class="search-filter">
                    <input type="text" class="search-box" placeholder="Search" name="search" value="{{ request('search') }}">
                    <button type="button" class="filter-btn" onclick="document.getElementById('filterModal').classList.add('active')">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M3 6h14M6 10h8M8 14h4" stroke="#333" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                </form>
                <div class="action-buttons">
                    <a href="{{ route('newhires.index') }}" class="btn btn-secondary">
                        <span>+</span> New Hire
                    </a>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name ⇅</th>
                            <th>Department ⇅</th>
                            <th>Position ⇅</th>
                            <th>Date Started ⇅</th>
                            <th>Type ⇅</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                        <tr>
                            <td>{{ str_pad($employee->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                            <td>{{ $employee->department }}</td>
                            <td>{{ $employee->job_category ?? 'N/A' }}</td>
                            <td>{{ $employee->start_date ? \Carbon\Carbon::parse($employee->start_date)->format('d/m/Y') : 'N/A' }}</td>
                            <td>{{ $employee->employment_type ?? 'Full time' }}</td>
                            <td>
                                <div class="action-icons">
                                    <button class="icon-btn" title="View" onclick="window.location.href='{{ route('employees.view', $employee) }}'">
                                        <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                            <path d="M10 4C5 4 2 10 2 10s3 6 8 6 8-6 8-6-3-6-8-6z" stroke="#0F2453" stroke-width="1.5"/>
                                            <circle cx="10" cy="10" r="2.5" stroke="#0F2453" stroke-width="1.5"/>
                                        </svg>
                                    </button>
                                    <button class="icon-btn" title="Edit" onclick="window.location.href='{{ route('employees.edit', $employee) }}'">
                                        <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                            <path d="M13 3l4 4L7 17H3v-4L13 3z" stroke="#0F2453" stroke-width="1.5"/>
                                        </svg>
                                    </button>
                                    <button class="icon-btn" title="Terminate" onclick="window.location.href='{{ route('terminations.create', $employee) }}'">
                                        <svg width="18" height="18" viewBox="0 0 20 20" fill="#0F2453">
                                            <rect x="4" y="6" width="12" height="12" rx="1"/>
                                            <path d="M3 6h14M8 3h4" stroke="#fff" stroke-width="1.5"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 30px;">No employees found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="pagination">
                    <div class="pagination-info">
                        Showing {{ $employees->firstItem() ?? 0 }}-{{ $employees->lastItem() ?? 0 }} Employee from {{ $employees->total() }}
                    </div>
                    <div class="pagination-controls">
                        @if($employees->onFirstPage())
                        <button class="page-btn" disabled style="opacity: 0.5; cursor: not-allowed;">‹</button>
                        @else
                        <button class="page-btn" onclick="window.location.href='{{ $employees->previousPageUrl() }}'">‹</button>
                        @endif
                        
                        @for($i = 1; $i <= $employees->lastPage(); $i++)
                        <button class="page-btn {{ $i == $employees->currentPage() ? 'active' : '' }}" onclick="window.location.href='{{ $employees->url($i) }}'">{{ $i }}</button>
                        @endfor
                        
                        @if($employees->hasMorePages())
                        <button class="page-btn" onclick="window.location.href='{{ $employees->nextPageUrl() }}'">›</button>
                        @else
                        <button class="page-btn" disabled style="opacity: 0.5; cursor: not-allowed;">›</button>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Filter Modal -->
    <div id="filterModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Search & Filter</h3>
                <button class="close-btn" onclick="document.getElementById('filterModal').classList.remove('active')">&times;</button>
            </div>
            <form method="GET" action="{{ route('employees.index') }}" class="modal-body">
                <div class="form-group">
                    <label>Search Name</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Enter employee name">
                </div>
                <div class="form-group">
                    <label>Department</label>
                    <select name="department">
                        <option value="">All Departments</option>
                        @foreach($departments as $dept)
                        <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Job Title</label>
                    <select name="job_category">
                        <option value="">All Positions</option>
                        @foreach($jobTitles as $title)
                        <option value="{{ $title }}" {{ request('job_category') == $title ? 'selected' : '' }}>{{ $title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-cancel" onclick="window.location.href='{{ route('employees.index') }}'">Clear</button>
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>