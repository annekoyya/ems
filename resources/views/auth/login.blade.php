<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Lotus Hotel - Employee Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="mx-auto w-20 h-20 bg-blue-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                <i class="fas fa-hotel text-white text-3xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Blue Lotus Hotel</h2>
            <p class="mt-2 text-gray-600 text-lg">Employee Portal</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                            <span class="text-red-700 text-sm font-medium">{{ $errors->first() }}</span>
                        </div>
                    </div>
                @endif

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            required 
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="employee@bluelotushotel.com"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            autofocus>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            required 
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Enter your password"
                            autocomplete="current-password">
                    </div>
                </div>

                {{-- <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            id="remember" 
                            name="remember" 
                            type="checkbox" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Remember me
                        </label>
                    </div> --}}
                    
                    {{-- <a href="#" class="text-sm text-blue-600 hover:text-blue-500 transition duration-200">
                        Forgot password?
                    </a>
                </div> --}}

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 transform hover:scale-[1.02]">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Sign in to Portal
                    </button>
                </div>
            </form>

            <!-- Demo Accounts Info -->
            <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                <p class="text-xs text-gray-600 text-center">
                    <strong>Demo Access:</strong><br>
                    HR: hr@bluelotus.com / password123<br>
                    Admin: admin@bluelotus.com / password123<br>
                    {{-- Manager: manager@bluelotus.com / password123 --}}
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-500">
                &copy; 2024 Blue Lotus Hotel. All rights reserved.
            </p>
            <p class="text-xs text-gray-400 mt-1">
                Contact IT Support for login assistance
            </p>
        </div>
    </div>
</body>
</html>