<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Employee Profile - Blue Lotus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        .bg-primary { background-color: #0F2453; }
        .bg-secondary { background-color: #45AEE4; }
        .bg-accent { background-color: #FAEC1D; }
        .text-primary { color: #0F2453; }
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4">
                <a href="{{ route('newhires.index') }}" class="text-secondary hover:text-primary transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-primary">Create Employee Profile</h1>
                    <p class="text-gray-600 mt-1">Complete the employee information form</p>
                </div>
            </div>
        </div>

        <!-- Alert for New Hire Info -->
        <div class="bg-blue-50 border-l-4 border-secondary p-4 rounded mb-6">
            <div class="flex">
                <svg class="h-5 w-5 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        <strong>New Hire:</strong> {{ $newHire->fullname }} - {{ $newHire->position }} ({{ $newHire->department }})
                    </p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('employees.store', $newHire) }}" class="space-y-6">
            @csrf

            <!-- Personal Information -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-primary px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Personal Information</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Department *</label>
                        <input type="text" name="department" value="{{ old('department', $newHire->department) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                        @error('department')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Job Category/Position</label>
                        <input type="text" name="job_category" value="{{ old('job_category', $newHire->position) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Employment Type</label>
                        <select name="employment_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            <option value="Full time">Full time</option>
                            <option value="Part time">Part time</option>
                            <option value="Contract">Contract</option>
                            <option value="Probationary">Probationary</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Reporting Manager *</label>
                        <input type="text" name="reporting_manager" value="{{ old('reporting_manager') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                        @error('reporting_manager')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('newhires.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-secondary text-white rounded-lg hover:bg-primary transition font-medium">
                    Create Employee Profile
                </button>
            </div>
        </form>
    </div>
</body>
</html>ibold text-gray-700 mb-2">First Name *</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                        @error('first_name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Last Name *</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                        @error('last_name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Middle Name</label>
                        <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Name Extension</label>
                        <input type="text" name="name_extension" value="{{ old('name_extension') }}" placeholder="Jr., Sr., III" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Date of Birth *</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                        @error('date_of_birth')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-primary px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Contact Information</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Home Address</label>
                        <textarea name="home_address" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">{{ old('home_address') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                        @error('email')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Emergency Contact Name</label>
                        <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Emergency Contact Number</label>
                        <input type="text" name="emergency_contact_number" value="{{ old('emergency_contact_number') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Relationship</label>
                        <input type="text" name="relationship" value="{{ old('relationship') }}" placeholder="e.g., Spouse, Parent, Sibling" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Financial Information -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-primary px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Financial Information</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">TIN</label>
                        <input type="text" name="tin" value="{{ old('tin') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">SSS Number</label>
                        <input type="text" name="sss_number" value="{{ old('sss_number') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pag-IBIG Number</label>
                        <input type="text" name="pagibig_number" value="{{ old('pagibig_number') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Bank Name</label>
                        <input type="text" name="bank_name" value="{{ old('bank_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Account Name</label>
                        <input type="text" name="account_name" value="{{ old('account_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Account Number</label>
                        <input type="text" name="account_number" value="{{ old('account_number') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Job Information -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-primary px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Job Information</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Start Date *</label>
                        <input type="date" name="start_date" value="{{ old('start_date') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                        @error('start_date')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-sem