<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminations - Blue Lotus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        .bg-primary { background-color: #0F2453; }
        .bg-secondary { background-color: #45AEE4; }
        .bg-accent { background-color: #FAEC1D; }
        .text-primary { color: #0F2453; }
        .text-secondary { color: #45AEE4; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-primary shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-accent rounded-lg flex items-center justify-center">
                            <span class="text-primary font-bold text-xl">BL</span>
                        </div>
                        <span class="text-white font-bold text-2xl">BLUE LOTUS</span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2 text-white">
                        <div class="w-8 h-8 bg-accent rounded-full flex items-center justify-center">
                            <span class="text-primary font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <span class="font-medium">{{ Auth::user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white hover:text-accent transition">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-primary min-h-screen">
            <nav class="mt-8">
                <a href="{{ route('employees.index') }}" class="flex items-center px-6 py-3 text-white hover:bg-secondary transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="{{ route('employees.index') }}" class="flex items-center px-6 py-3 text-white hover:bg-secondary transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span class="font-medium">Employee</span>
                </a>
                <a href="{{ route('newhires.index') }}" class="flex items-center px-6 py-3 text-white hover:bg-secondary transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    <span class="font-medium">Newhire</span>
                </a>
                <a href="{{ route('terminations.index') }}" class="flex items-center px-6 py-3 bg-secondary text-white">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="font-medium">Termination</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-white hover:bg-secondary transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium">Payroll</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-white hover:bg-secondary transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span class="font-medium">Performance</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-white hover:bg-secondary transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                    </svg>
                    <span class="font-medium">Recruitment</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Success Message -->
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
            @endif

            <!-- Header -->
            <div class="mb-8">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h1 class="text-3xl font-bold text-primary">Termination Records</h1>
                    <p class="text-gray-600 mt-1">View all employee termination records</p>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Employee Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Department</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Position</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Last Working Day</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Reason</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Date Processed</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($terminations as $termination)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm font-medium">
                                {{ $termination->employee ? $termination->employee->first_name . ' ' . $termination->employee->last_name : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $termination->employee->department ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm">{{ $termination->employee->job_category ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm">{{ \Carbon\Carbon::parse($termination->last_working_day)->format('m/d/Y') }}</td>
                            <td class="px-6 py-4 text-sm">{{ Str::limit($termination->reason, 50) }}</td>
                            <td class="px-6 py-4 text-sm">{{ $termination->created_at->format('m/d/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-lg font-medium">No termination records found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                @if($terminations->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            Showing {{ $terminations->firstItem() }} to {{ $terminations->lastItem() }} of {{ $terminations->total() }} entries
                        </div>
                        <div class="flex space-x-2">
                            {{ $terminations->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>