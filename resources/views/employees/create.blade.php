@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded">
    <h1 class="text-2xl font-bold mb-6">Create Employee Profile for {{ $newHire->name }}</h1>

    <form action="{{ route('employees.store', $newHire->id) }}" method="POST">
        @csrf

        <!-- Personal Info -->
        <h2 class="font-semibold text-lg mb-2">Personal Information</h2>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <input type="text" name="first_name" value="{{ old('first_name', $newHire->name) }}" placeholder="First Name" class="border rounded p-2" required>
            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" class="border rounded p-2" required>
            <input type="text" name="middle_name" value="{{ old('middle_name') }}" placeholder="Middle Name" class="border rounded p-2">
            <input type="text" name="name_extension" value="{{ old('name_extension') }}" placeholder="Name Extension" class="border rounded p-2">
            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="border rounded p-2" required>
        </div>

        <!-- Contact Info -->
        <h2 class="font-semibold text-lg mb-2">Contact Details</h2>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <input type="text" name="home_address" value="{{ old('home_address') }}" placeholder="Home Address" class="border rounded p-2">
            <input type="text" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone Number" class="border rounded p-2">
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="border rounded p-2" required>
            <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" placeholder="Emergency Contact Name" class="border rounded p-2">
            <input type="text" name="emergency_contact_number" value="{{ old('emergency_contact_number') }}" placeholder="Emergency Contact Number" class="border rounded p-2">
            <input type="text" name="relationship" value="{{ old('relationship') }}" placeholder="Relationship" class="border rounded p-2">
        </div>

        <!-- Financial Info -->
        <h2 class="font-semibold text-lg mb-2">Financial Details</h2>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <input type="text" name="tin" value="{{ old('tin') }}" placeholder="TIN" class="border rounded p-2">
            <input type="text" name="sss_number" value="{{ old('sss_number') }}" placeholder="SSS Number" class="border rounded p-2">
            <input type="text" name="pagibig_number" value="{{ old('pagibig_number') }}" placeholder="Pag-IBIG Number" class="border rounded p-2">
            <input type="text" name="bank_name" value="{{ old('bank_name') }}" placeholder="Bank Name" class="border rounded p-2">
            <input type="text" name="account_name" value="{{ old('account_name') }}" placeholder="Account Name" class="border rounded p-2">
            <input type="text" name="account_number" value="{{ old('account_number') }}" placeholder="Account Number" class="border rounded p-2">
        </div>

        <!-- Job Information -->
        <h2 class="font-semibold text-lg mb-2">Job Information</h2>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <!-- Start Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Start Date *</label>
                <input type="date" name="start_date" value="{{ old('start_date') }}" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            
            <!-- Department Dropdown -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Department *</label>
                <select name="department" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Select Department</option>
                    <option value="Front Office" {{ old('department', $newHire->department ?? '') == 'Front Office' ? 'selected' : '' }}>Front Office</option>
                    <option value="Housekeeping" {{ old('department', $newHire->department ?? '') == 'Housekeeping' ? 'selected' : '' }}>Housekeeping</option>
                    <option value="Food & Beverage" {{ old('department', $newHire->department ?? '') == 'Food & Beverage' ? 'selected' : '' }}>Food & Beverage</option>
                    <option value="Kitchen" {{ old('department', $newHire->department ?? '') == 'Kitchen' ? 'selected' : '' }}>Kitchen</option>
                    <option value="Sales & Marketing" {{ old('department', $newHire->department ?? '') == 'Sales & Marketing' ? 'selected' : '' }}>Sales & Marketing</option>
                    <option value="Finance" {{ old('department', $newHire->department ?? '') == 'Finance' ? 'selected' : '' }}>Finance</option>
                    <option value="Human Resources" {{ old('department', $newHire->department ?? '') == 'Human Resources' ? 'selected' : '' }}>Human Resources</option>
                    <option value="IT" {{ old('department', $newHire->department ?? '') == 'IT' ? 'selected' : '' }}>IT</option>
                    <option value="Maintenance" {{ old('department', $newHire->department ?? '') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="Security" {{ old('department', $newHire->department ?? '') == 'Security' ? 'selected' : '' }}>Security</option>
                    <option value="Spa & Wellness" {{ old('department', $newHire->department ?? '') == 'Spa & Wellness' ? 'selected' : '' }}>Spa & Wellness</option>
                </select>
            </div>
            
            <!-- Job Category Dropdown -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Job Category</label>
                <select name="job_category" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Job Category</option>
                    <option value="Front Desk Agent" {{ old('job_category') == 'Front Desk Agent' ? 'selected' : '' }}>Front Desk Agent</option>
                    <option value="Concierge" {{ old('job_category') == 'Concierge' ? 'selected' : '' }}>Concierge</option>
                    <option value="Bellman" {{ old('job_category') == 'Bellman' ? 'selected' : '' }}>Bellman</option>
                    <option value="Housekeeper" {{ old('job_category') == 'Housekeeper' ? 'selected' : '' }}>Housekeeper</option>
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
                <label class="block text-sm font-medium text-gray-700 mb-1">Employment Type</label>
                <select name="employment_type" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
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
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Reporting Manager *</label>
                <input type="text" name="reporting_manager" value="{{ old('reporting_manager') }}" 
                       placeholder="Enter reporting manager's name"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200 font-medium">
                Create Employee Profile
            </button>
        </div>
    </form>
</div>
@endsection