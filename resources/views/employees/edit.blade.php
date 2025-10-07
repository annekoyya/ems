
@extends('layouts.app')

@section('page-title', 'Edit Employee')
@section('page-subtitle', 'Update employee information')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-6">Edit Employee</h2>

    <form id="employeeEditForm" action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Employee ID (read-only) -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Employee ID</label>
                <input type="text" value="{{ $employee->id }}" readonly
                    class="w-full border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed p-2">
            </div>

            <!-- First Name -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">First Name *</label>
                <input type="text" name="first_name" 
                    value="{{ old('first_name', $employee->first_name) }}"
                    class="w-full border rounded-lg p-2 @error('first_name') border-red-500 @enderror" 
                    required
                    minlength="2"
                    maxlength="50">
                @error('first_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Last Name -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Last Name *</label>
                <input type="text" name="last_name" 
                    value="{{ old('last_name', $employee->last_name) }}"
                    class="w-full border rounded-lg p-2 @error('last_name') border-red-500 @enderror" 
                    required
                    minlength="2"
                    maxlength="50">
                @error('last_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Middle Name -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Middle Name</label>
                <input type="text" name="middle_name" 
                    value="{{ old('middle_name', $employee->middle_name) }}"
                    class="w-full border rounded-lg p-2 @error('middle_name') border-red-500 @enderror"
                    maxlength="50">
                @error('middle_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Name Extension -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Name Extension</label>
                <input type="text" name="name_extension" 
                    value="{{ old('name_extension', $employee->name_extension) }}"
                    class="w-full border rounded-lg p-2 @error('name_extension') border-red-500 @enderror"
                    maxlength="10">
                @error('name_extension')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Email *</label>
                <input type="email" name="email" 
                    value="{{ old('email', $employee->email) }}"
                    class="w-full border rounded-lg p-2 @error('email') border-red-500 @enderror" 
                    required>
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date of Birth (read-only) -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Date of Birth</label>
                <input type="date" value="{{ $employee->date_of_birth }}" readonly
                    class="w-full border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed p-2">
            </div>

            <!-- Start Date (read-only) -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Start Date</label>
                <input type="date" value="{{ $employee->start_date }}" readonly
                    class="w-full border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed p-2">
            </div>

            <!-- Department (Dropdown) -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Department *</label>
                <select name="department" 
                        class="w-full border rounded-lg p-2 @error('department') border-red-500 @enderror" required>
                    <option value="">Select Department</option>
                    <option value="HR" {{ old('department', $employee->department) == 'HR' ? 'selected' : '' }}>HR</option>
                    <option value="IT" {{ old('department', $employee->department) == 'IT' ? 'selected' : '' }}>IT</option>
                    <option value="Finance" {{ old('department', $employee->department) == 'Finance' ? 'selected' : '' }}>Finance</option>
                    <option value="Operations" {{ old('department', $employee->department) == 'Operations' ? 'selected' : '' }}>Operations</option>
                    <option value="Front Office" {{ old('department', $employee->department) == 'Front Office' ? 'selected' : '' }}>Front Office</option>
                    <option value="Food & Beverages" {{ old('department', $employee->department) == 'Food & Beverages' ? 'selected' : '' }}>Food & Beverages</option>
                    <option value="Housekeeping" {{ old('department', $employee->department) == 'Housekeeping' ? 'selected' : '' }}>Housekeeping</option>
                    <option value="Sales & Marketing" {{ old('department', $employee->department) == 'Sales & Marketing' ? 'selected' : '' }}>Sales & Marketing</option>
                    <option value="Engineering & Maintenance" {{ old('department', $employee->department) == 'Engineering & Maintenance' ? 'selected' : '' }}>Engineering & Maintenance</option>
                    <option value="Security" {{ old('department', $employee->department) == 'Security' ? 'selected' : '' }}>Security</option>
                    <option value="Spa & Wellness" {{ old('department', $employee->department) == 'Spa & Wellness' ? 'selected' : '' }}>Spa & Wellness</option>
                    <option value="Purchasing / Procurement" {{ old('department', $employee->department) == 'Purchasing / Procurement' ? 'selected' : '' }}>Purchasing / Procurement</option>
                    <option value="Laundry" {{ old('department', $employee->department) == 'Laundry' ? 'selected' : '' }}>Laundry</option>
                    <option value="Events & Banquets" {{ old('department', $employee->department) == 'Events & Banquets' ? 'selected' : '' }}>Events & Banquets</option>
                    <option value="Guest Services / Concierge" {{ old('department', $employee->department) == 'Guest Services / Concierge' ? 'selected' : '' }}>Guest Services / Concierge</option>
                </select>
                @error('department')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- <!-- Job Title -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Job Title *</label>
                <input type="text" name="job_title" 
                    value="{{ old('job_title', $employee->job_title) }}"
                    class="w-full border rounded-lg p-2 @error('job_title') border-red-500 @enderror" 
                    required
                    maxlength="100">
                @error('job_title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div> --}}

            <!-- Job Category -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Job Category</label>
                <input type="text" name="job_category" 
                    value="{{ old('job_category', $employee->job_category) }}"
                    class="w-full border rounded-lg p-2 @error('job_category') border-red-500 @enderror"
                    maxlength="100">
                @error('job_category')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Reporting Manager -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Reporting Manager *</label>
                <input type="text" name="reporting_manager" 
                    value="{{ old('reporting_manager', $employee->reporting_manager) }}"
                    class="w-full border rounded-lg p-2 @error('reporting_manager') border-red-500 @enderror" 
                    required
                    minlength="2"
                    maxlength="100">
                @error('reporting_manager')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
         <!-- Home Address -->
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-medium mb-1">Home Address</label>
                <textarea name="home_address" rows="3"
                    class="w-full border rounded-lg p-2 @error('home_address') border-red-500 @enderror"
                    maxlength="255">{{ old('home_address', $employee->home_address) }}</textarea>
                @error('home_address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Phone Number -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Phone Number</label>
                <input type="tel" name="phone_number" 
                    value="{{ old('phone_number', $employee->phone_number) }}"
                    class="w-full border rounded-lg p-2 @error('phone_number') border-red-500 @enderror"
                    placeholder="09171234567">
                @error('phone_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Emergency Contact Number -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Emergency Contact Number</label>
                <input type="tel" name="emergency_contact_number" 
                    value="{{ old('emergency_contact_number', $employee->emergency_contact_number) }}"
                    class="w-full border rounded-lg p-2 @error('emergency_contact_number') border-red-500 @enderror"
                    placeholder="09171234567">
                @error('emergency_contact_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Emergency Contact Name -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Emergency Contact Name</label>
                <input type="text" name="emergency_contact_name" 
                    value="{{ old('emergency_contact_name', $employee->emergency_contact_name) }}"
                    class="w-full border rounded-lg p-2 @error('emergency_contact_name') border-red-500 @enderror"
                    maxlength="100">
                @error('emergency_contact_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Relationship -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Relationship</label>
                <input type="text" name="relationship" 
                    value="{{ old('relationship', $employee->relationship) }}"
                    class="w-full border rounded-lg p-2 @error('relationship') border-red-500 @enderror"
                    maxlength="50">
                @error('relationship')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- TIN Number -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">TIN Number</label>
                <input type="text" name="tin" 
                    value="{{ old('tin', $employee->tin) }}"
                    class="w-full border rounded-lg p-2 @error('tin') border-red-500 @enderror"
                    placeholder="123456789">
                @error('tin')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- SSS Number -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">SSS Number</label>
                <input type="text" name="sss_number" 
                    value="{{ old('sss_number', $employee->sss_number) }}"
                    class="w-full border rounded-lg p-2 @error('sss_number') border-red-500 @enderror"
                    placeholder="0123456789">
                @error('sss_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pag-IBIG Number -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Pag-IBIG Number</label>
                <input type="text" name="pagibig_number" 
                    value="{{ old('pagibig_number', $employee->pagibig_number) }}"
                    class="w-full border rounded-lg p-2 @error('pagibig_number') border-red-500 @enderror"
                    placeholder="123456789012">
                @error('pagibig_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

   

            <!-- Bank Details -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Bank Name</label>
                <input type="text" name="bank_name" 
                    value="{{ old('bank_name', $employee->bank_name) }}"
                    class="w-full border rounded-lg p-2 @error('bank_name') border-red-500 @enderror"
                    maxlength="100">
                @error('bank_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Account Name</label>
                <input type="text" name="account_name" 
                    value="{{ old('account_name', $employee->account_name) }}"
                    class="w-full border rounded-lg p-2 @error('account_name') border-red-500 @enderror"
                    maxlength="100">
                @error('account_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Account Number</label>
                <input type="text" name="account_number" 
                    value="{{ old('account_number', $employee->account_number) }}"
                    class="w-full border rounded-lg p-2 @error('account_number') border-red-500 @enderror"
                    placeholder="1234567890">
                @error('account_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Submit -->
        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('employees.index') }}" 
               class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition-colors">Cancel</a>
            <button type="submit" 
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Update Employee</button>
        </div>
    </form>
</div>



@if(session('error'))
<div id="toast-error" class="fixed top-5 right-5 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 transform transition-all duration-300 ease-in-out animate-fade-in">
    <div class="flex items-center space-x-3">
        <div class="flex-shrink-0">
            <i class="fas fa-exclamation-circle text-lg"></i>
        </div>
        <div class="flex-1">
            <p class="font-medium">{{ session('error') }}</p>
        </div>
        <button onclick="hideToast('toast-error')" class="flex-shrink-0 ml-4 text-white hover:text-red-100 transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    function hideToast(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.style.transform = 'translateX(100%)';
            toast.style.opacity = '0';
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 300);
        }
    }

    // Auto-hide toast after 5 seconds
    document.addEventListener("DOMContentLoaded", function () {
        const successToast = document.getElementById("toast-success");
        const errorToast = document.getElementById("toast-error");
        
        if (successToast) {
            setTimeout(() => {
                hideToast('toast-success');
            }, 5000);
        }
        
        if (errorToast) {
            setTimeout(() => {
                hideToast('toast-error');
            }, 5000);
        }

        // Add real-time validation feedback
        const inputs = document.querySelectorAll('input[required], select[required]');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.classList.add('border-red-500');
                } else {
                    this.classList.remove('border-red-500');
                }
            });
        });

        // Form submission handler
        const form = document.getElementById('employeeEditForm');
        form.addEventListener('submit', function(e) {
            // Basic validation before submit
            const requiredInputs = form.querySelectorAll('input[required], select[required]');
            let isValid = true;

            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('border-red-500');
                    
                    // Scroll to first error
                    if (isValid) {
                        input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
                // Show first error message
                const firstError = form.querySelector('.border-red-500');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    });
</script>

<style>
    .animate-fade-in {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Ensure buttons are clickable */
    button {
        cursor: pointer;
    }

    button:disabled {
        cursor: not-allowed;
        opacity: 0.6;
    }
</style>
@endsection