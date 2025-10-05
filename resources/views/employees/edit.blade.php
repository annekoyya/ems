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
                    class="w-full border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed">
            </div>

            <!-- First Name -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">First Name *</label>
                <input type="text" name="first_name" 
                    value="{{ old('first_name', $employee->first_name) }}"
                    class="w-full border rounded-lg p-2 @error('first_name') border-red-500 @enderror" 
                    required
                    minlength="2"
                    maxlength="50"
                    pattern="[A-Za-z\s]+"
                    title="Only letters and spaces are allowed">
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
                    maxlength="50"
                    pattern="[A-Za-z\s]+"
                    title="Only letters and spaces are allowed">
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
                    maxlength="50"
                    pattern="[A-Za-z\s]*"
                    title="Only letters and spaces are allowed">
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
                    maxlength="10"
                    pattern="[A-Za-z\.]*"
                    title="Only letters and dots are allowed (e.g., Jr., Sr.)">
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
                    required
                    pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                    title="Please enter a valid email address (e.g., name@company.com)">
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date of Birth (read-only) -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Date of Birth</label>
                <input type="date" value="{{ $employee->date_of_birth }}" readonly
                    class="w-full border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed">
            </div>

            <!-- Start Date (read-only) -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Start Date</label>
                <input type="date" value="{{ $employee->start_date }}" readonly
                    class="w-full border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed">
            </div>

            <!-- Department (Dropdown) -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Department *</label>
                <select name="department" 
                        class="w-full border rounded-lg p-2 @error('department') border-red-500 @enderror" required>
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

            <!-- Phone Number -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Phone Number</label>
                <input type="tel" name="phone_number" 
                    value="{{ old('phone_number', $employee->phone_number) }}"
                    class="w-full border rounded-lg p-2 @error('phone_number') border-red-500 @enderror"
                    pattern="[0-9]{10,13}"
                    title="Phone number should be 10-13 digits (e.g., 09171234567)"
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
                    pattern="[0-9]{10,13}"
                    title="Phone number should be 10-13 digits (e.g., 09171234567)"
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
                    maxlength="100"
                    pattern="[A-Za-z\s]+"
                    title="Only letters and spaces are allowed">
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
                    maxlength="50"
                    pattern="[A-Za-z\s]+"
                    title="Only letters and spaces are allowed">
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
                    pattern="[0-9]{9,12}"
                    title="TIN should be 9-12 digits"
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
                    pattern="[0-9]{10,12}"
                    title="SSS number should be 10-12 digits"
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
                    pattern="[0-9]{12}"
                    title="Pag-IBIG number should be exactly 12 digits"
                    placeholder="123456789012">
                @error('pagibig_number')
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
                    maxlength="100"
                    pattern="[A-Za-z\s]+"
                    title="Only letters and spaces are allowed">
                @error('account_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Account Number</label>
                <input type="text" name="account_number" 
                    value="{{ old('account_number', $employee->account_number) }}"
                    class="w-full border rounded-lg p-2 @error('account_number') border-red-500 @enderror"
                    pattern="[0-9]{10,18}"
                    title="Account number should be 10-18 digits"
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
            <button type="button" 
                    onclick="validateForm()"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Update</button>
        </div>
    </form>
</div>

<!-- ✅ Confirmation Modal -->
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96 shadow-lg">
        <h2 class="text-lg font-bold mb-4">Confirm Update</h2>
        <p class="mb-6">Are you sure you want to update this employee profile?</p>
        <div class="flex justify-end space-x-3">
            <button onclick="closeConfirmModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition-colors">Cancel</button>
            <button onclick="submitForm()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Confirm</button>
        </div>
    </div>
</div>

<!-- ✅ Validation Error Modal -->
<div id="errorModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96 shadow-lg">
        <div class="flex items-center mb-4">
            <div class="w-6 h-6 bg-red-500 rounded-full flex items-center justify-center mr-3">
                <i class="fas fa-exclamation text-white text-xs"></i>
            </div>
            <h2 class="text-lg font-bold text-red-600">Validation Error</h2>
        </div>
        <p id="errorMessage" class="mb-6 text-gray-700"></p>
        <div class="flex justify-end">
            <button onclick="closeErrorModal()" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors">OK</button>
        </div>
    </div>
</div>

<!-- ✅ Toast Notification -->
@if(session('success'))
<div id="toast" class="fixed top-5 right-5 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 transform transition-all duration-300 ease-in-out animate-fade-in">
    <div class="flex items-center space-x-3">
        <div class="flex-shrink-0">
            <i class="fas fa-check-circle text-lg"></i>
        </div>
        <div class="flex-1">
            <p class="font-medium">{{ session('success') }}</p>
        </div>
        <button onclick="hideToast()" class="flex-shrink-0 ml-4 text-white hover:text-green-100 transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif

@if(session('error'))
<div id="toast" class="fixed top-5 right-5 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 transform transition-all duration-300 ease-in-out animate-fade-in">
    <div class="flex items-center space-x-3">
        <div class="flex-shrink-0">
            <i class="fas fa-exclamation-circle text-lg"></i>
        </div>
        <div class="flex-1">
            <p class="font-medium">{{ session('error') }}</p>
        </div>
        <button onclick="hideToast()" class="flex-shrink-0 ml-4 text-white hover:text-red-100 transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    function validateForm() {
        const form = document.getElementById('employeeEditForm');
        const inputs = form.querySelectorAll('input[required], select[required]');
        let isValid = true;
        let errorMessage = '';

        // Check required fields
        for (let input of inputs) {
            if (!input.value.trim()) {
                isValid = false;
                errorMessage = `Please fill in all required fields: ${input.previousElementSibling.textContent.replace('*', '').trim()}`;
                break;
            }
        }

        // Email validation
        const emailInput = form.querySelector('input[type="email"]');
        if (isValid && emailInput.value) {
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(emailInput.value)) {
                isValid = false;
                errorMessage = 'Please enter a valid email address (e.g., name@company.com)';
            }
        }

        // Phone number validation (if provided)
        const phoneInput = form.querySelector('input[name="phone_number"]');
        if (isValid && phoneInput.value) {
            const phoneRegex = /^[0-9]{10,13}$/;
            if (!phoneRegex.test(phoneInput.value.replace(/\D/g, ''))) {
                isValid = false;
                errorMessage = 'Phone number should be 10-13 digits (e.g., 09171234567)';
            }
        }

        // Emergency contact number validation (if provided)
        const emergencyPhoneInput = form.querySelector('input[name="emergency_contact_number"]');
        if (isValid && emergencyPhoneInput.value) {
            const phoneRegex = /^[0-9]{10,13}$/;
            if (!phoneRegex.test(emergencyPhoneInput.value.replace(/\D/g, ''))) {
                isValid = false;
                errorMessage = 'Emergency contact number should be 10-13 digits';
            }
        }

        // Bank account number validation (if provided)
        const accountInput = form.querySelector('input[name="account_number"]');
        if (isValid && accountInput.value) {
            const accountRegex = /^[0-9]{10,18}$/;
            if (!accountRegex.test(accountInput.value)) {
                isValid = false;
                errorMessage = 'Bank account number should be 10-18 digits';
            }
        }

        if (!isValid) {
            document.getElementById('errorMessage').textContent = errorMessage;
            document.getElementById('errorModal').classList.remove('hidden');
            return;
        }

        // If all validations pass, show confirmation modal
        openConfirmModal();
    }

    function openConfirmModal() {
        document.getElementById('confirmModal').classList.remove('hidden');
    }

    function closeConfirmModal() {
        document.getElementById('confirmModal').classList.add('hidden');
    }

    function closeErrorModal() {
        document.getElementById('errorModal').classList.add('hidden');
    }

    function submitForm() {
        document.getElementById('employeeEditForm').submit();
    }

    function hideToast() {
        const toast = document.getElementById('toast');
        if (toast) {
            toast.style.transform = 'translateX(100%)';
            toast.style.opacity = '0';
            setTimeout(() => {
                toast.remove();
            }, 300);
        }
    }

    // Auto-hide toast after 5 seconds
    document.addEventListener("DOMContentLoaded", function () {
        const toast = document.getElementById("toast");
        if (toast) {
            setTimeout(() => {
                hideToast();
            }, 5000);
        }

        // Real-time validation feedback
        const inputs = document.querySelectorAll('input[pattern]');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value && !this.checkValidity()) {
                    this.classList.add('border-red-500');
                } else {
                    this.classList.remove('border-red-500');
                }
            });
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

/* Custom validation styles */
input:invalid:not(:focus):not(:placeholder-shown) {
    border-color: #ef4444;
}

input:valid:not(:focus):not(:placeholder-shown) {
    border-color: #10b981;
}
</style>
@endsection