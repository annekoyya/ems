

@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md p-8 mt-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Add New Hire</h2>
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-4">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                <span class="text-red-700 text-sm font-medium">{{ $errors->first() }}</span>
            </div>
        </div>
    @endif
    <form action="{{ route('newhires.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Enter full name" required>
            </div>
            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Enter email address" required>
            </div>
            <!-- Job Category Dropdown -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Job Category *</label>
                <select name="job_category"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Select Job Category</option>
                    <option value="Front Desk" {{ old('job_category') == 'Front Desk' ? 'selected' : '' }}>Front Desk</option>
                    <option value="Housekeeping" {{ old('job_category') == 'Housekeeping' ? 'selected' : '' }}>Housekeeping</option>
                    <option value="Supervisor" {{ old('job_category') == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                    <option value="Manager" {{ old('job_category') == 'Manager' ? 'selected' : '' }}>Manager</option>
                    <option value="Chef" {{ old('job_category') == 'Chef' ? 'selected' : '' }}>Chef</option>
                    <option value="Cook" {{ old('job_category') == 'Cook' ? 'selected' : '' }}>Cook</option>
                    <option value="Server" {{ old('job_category') == 'Server' ? 'selected' : '' }}>Server</option>
                    <option value="Bartender" {{ old('job_category') == 'Bartender' ? 'selected' : '' }}>Bartender</option>
                    <option value="Accountant" {{ old('job_category') == 'Accountant' ? 'selected' : '' }}>Accountant</option>
                    <option value="HR Specialist" {{ old('job_category') == 'HR Specialist' ? 'selected' : '' }}>HR Specialist</option>
                    <option value="IT Support" {{ old('job_category') == 'IT Support' ? 'selected' : '' }}>IT Support</option>
                    <option value="Maintenance Technician" {{ old('job_category') == 'Maintenance Technician' ? 'selected' : '' }}>Maintenance Technician</option>
                    <option value="Security Officer" {{ old('job_category') == 'Security Officer' ? 'selected' : '' }}>Security Officer</option>
                    <option value="Therapist" {{ old('job_category') == 'Therapist' ? 'selected' : '' }}>Therapist</option>
                </select>
            </div>
            <!-- Employment Type Dropdown -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Employment Type *</label>
                <select name="employment_type"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Select Employment Type</option>
                    <option value="Full-time" {{ old('employment_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ old('employment_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="Contract" {{ old('employment_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                    <option value="Seasonal" {{ old('employment_type') == 'Seasonal' ? 'selected' : '' }}>Seasonal</option>
                    <option value="Temporary" {{ old('employment_type') == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                    <option value="Internship" {{ old('employment_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                </select>
            </div>
            <!-- Reporting Manager -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Reporting Manager *</label>
                <input type="text" name="reporting_manager" value="{{ old('reporting_manager') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Enter reporting manager's name" required>
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200 font-medium">
                Create Employee Profile
            </button>
        </div>
    </form>
</div>
@endsection


