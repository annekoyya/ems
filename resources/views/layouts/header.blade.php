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
            {{-- <button class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition duration-200">
                <i class="fas fa-bell"></i>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
            </button> --}}

            <!-- User Menu -->
            <div class="relative" id="userMenu">
                <button onclick="toggleDropdown()" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition duration-200">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-sm">
                            @auth
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            @else
                                U
                            @endauth
                        </span>
                    </div>
                    <div class="text-left hidden md:block">
                        <p class="text-sm font-medium text-gray-800">
                            @auth
                                {{ Auth::user()->name }}
                            @else
                                Guest User
                            @endauth
                        </p>
                        <p class="text-xs text-gray-600 capitalize">
                            @auth
                                {{ Auth::user()->role }}
                            @else
                                Guest
                            @endauth
                        </p>
                    </div>
                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                </button>

                <!-- Dropdown Menu -->
                <div id="userDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                    <!-- Profile Info -->
                    <div class="px-4 py-3 border-b border-gray-200">
                        <p class="text-sm font-medium text-gray-900">
                            @auth
                                {{ Auth::user()->name }}
                            @else
                                Guest User
                            @endauth
                        </p>
                        <p class="text-xs text-gray-600">
                            @auth
                                {{ Auth::user()->email }}
                            @else
                                Not logged in
                            @endauth
                        </p>
                        <p class="text-xs text-gray-500 mt-1 capitalize">
                            @auth
                                Role: {{ Auth::user()->role }}
                            @else
                                Role: Guest
                            @endauth
                        </p>
                    </div>

                    <!-- Profile Link -->
                    <a href="#" class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-200">
                        <i class="fas fa-user w-5 text-center"></i>
                        <span>My Profile</span>
                    </a>
                    
                    <!-- Settings -->
                    <a href="#" class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-200">
                        <i class="fas fa-cog w-5 text-center"></i>
                        <span>Settings</span>
                    </a>
                    
                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-1"></div>
                    
                    <!-- Logout Form -->
                    @auth
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition duration-200 w-full text-left">
                            <i class="fas fa-sign-out-alt w-5 text-center"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="flex items-center space-x-3 px-4 py-2 text-sm text-blue-600 hover:bg-gray-100 transition duration-200">
                        <i class="fas fa-sign-in-alt w-5 text-center"></i>
                        <span>Login</span>
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>

<script>
// Toggle dropdown
function toggleDropdown() {
    const dropdown = document.getElementById('userDropdown');
    dropdown.classList.toggle('hidden');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('userDropdown');
    const userMenu = document.getElementById('userMenu');
    
    if (!userMenu.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
});

// Close dropdown with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        document.getElementById('userDropdown').classList.add('hidden');
    }
});
</script>