<!-- Sidebar -->
<div id="sidebar" class="sidebar bg-blue-900 text-white w-64 lg:flex flex-col hidden lg:flex">
    <!-- Logo -->
    <div class="p-6 border-b border-blue-800 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                <i class="fas fa-hotel text-blue-600 text-lg"></i>
            </div>
            <span class="sidebar-text font-bold text-lg">Blue Lotus Hotel</span>
        </div>
        <button onclick="toggleSidebar()" class="lg:hidden text-blue-200 hover:text-white">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('employees.index') }}" 
           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-800 transition duration-200 {{ request()->routeIs('employees.index') ? 'bg-blue-800' : '' }}">
            <i class="fas fa-chart-line w-5 text-center"></i>
            <span class="sidebar-text">Dashboard</span>
        </a>

        <!-- Employee -->
        <div class="mt-6">
            <p class="sidebar-text text-blue-300 text-xs uppercase font-semibold mb-2 px-3">Employee Management</p>
            <a href="{{ route('employees.index') }}" 
               class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-800 transition duration-200 {{ request()->routeIs('employees.*') ? 'bg-blue-800' : '' }}">
                <i class="fas fa-users w-5 text-center"></i>
                <span class="sidebar-text">Employee List</span>
            </a>
            
            {{-- <a href="{{ route('newhires.index') }}" 
               class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-800 transition duration-200 {{ request()->routeIs('newhires.*') ? 'bg-blue-800' : '' }}">
                <i class="fas fa-user-plus w-5 text-center"></i>
                <span class="sidebar-text">New Hires</span>
                <span class="ml-auto bg-orange-500 text-white text-xs px-2 py-1 rounded-full">
                    {{ \App\Models\NewHire::where('status', 'pending')->count() }}
                </span>
            </a> --}}
            {{-- <p class="sidebar-text text-blue-300 text-xs uppercase font-semibold mb-2 px-3">Other Modules</p> --}}
            
            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-800 transition duration-200">
                <i class="fas fa-calendar-check w-5 text-center"></i>
                <span class="sidebar-text">Attendance</span>
            </a>
            
            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-800 transition duration-200">
                <i class="fas fa-money-bill-wave w-5 text-center"></i>
                <span class="sidebar-text">Payroll</span>
            </a>
            
            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-800 transition duration-200">
                <i class="fas fa-chart-bar w-5 text-center"></i>
                <span class="sidebar-text">Performance</span>
            </a>
            
            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-800 transition duration-200">
                <i class="fas fa-briefcase w-5 text-center"></i>
                <span class="sidebar-text">Recruitment</span>
            </a>
        </div>
    </nav>

    <!-- Sidebar Footer -->
    <div class="p-4 border-t border-blue-800">
        <button onclick="toggleSidebar()" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-blue-800 transition duration-200 w-full text-left">
            <i class="fas fa-chevron-left w-5 text-center"></i>
            <span class="sidebar-text">Collapse</span>
        </button>
    </div>
</div>

<!-- Mobile Sidebar Overlay -->
<div id="mobileOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden" onclick="toggleSidebar()"></div>