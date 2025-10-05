<!-- Header -->
<header class="bg-white border-b border-gray-200">
    <div class="flex items-center justify-between p-4">
        <!-- Left Section -->
        <div class="flex items-center space-x-4">
            <!-- Mobile Menu Button -->
            <button onclick="toggleSidebar()" class="lg:hidden text-gray-600 hover:text-gray-900">
                <i class="fas fa-bars text-lg"></i>
            </button>
            
            <!-- Page Title -->
            <div>
                <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Employee Management')</h1>
                <p class="text-sm text-gray-600">@yield('page-subtitle', 'Manage your hotel staff and their information')</p>
            </div>
        </div>

        <!-- Right Section -->
        <div class="flex items-center space-x-4">
            <!-- Notifications -->
            <button class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition duration-200">
                <i class="fas fa-bell"></i>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
            </button>

            <!-- User Menu -->
            <div class="relative" id="userMenu">
                <button onclick="toggleDropdown()" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition duration-200">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-sm">A</span>
                    </div>
                    <div class="text-left hidden md:block">
                        <p class="text-sm font-medium text-gray-800">Admin User</p>
                        <p class="text-xs text-gray-600">Administrator</p>
                    </div>
                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                </button>

                <!-- Dropdown Menu -->
                <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                    <a href="#" class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-200">
                        <i class="fas fa-user w-5 text-center"></i>
                        <span>Profile</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-200">
                        <i class="fas fa-cog w-5 text-center"></i>
                        <span>Settings</span>
                    </a>
                    <div class="border-t border-gray-200 my-1"></div>
                    <a href="auth.login" class="flex items-center space-x-3 px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition duration-200">
                        <i class="fas fa-sign-out-alt w-5 text-center"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>