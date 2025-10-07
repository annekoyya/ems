@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded" x-data="employeeForm()">
    <h1 class="text-2xl font-bold mb-6">Create Employee Profile for {{ $newHire->name }}</h1>

    <!-- Error Display -->
    <template x-if="Object.keys(errors).length > 0">
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
            <h3 class="text-red-800 font-semibold mb-2">Please fix the following errors:</h3>
            <ul class="list-disc list-inside text-red-700">
                <template x-for="error in Object.values(errors)" :key="error">
                    <li x-text="error"></li>
                </template>
            </ul>
        </div>
    </template>

    <form @submit.prevent="validateForm" action="{{ route('employees.store', $newHire->id) }}" method="POST" id="employeeForm">
        @csrf

        <!-- Personal Info -->
        <h2 class="font-semibold text-lg mb-2">Personal Information</h2>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                <input type="text" name="first_name" 
                       value="{{ old('first_name', $newHire->first_name) }}"
                       x-model="formData.first_name"
                       :class="errors.first_name ? 'border-red-500' : 'border-gray-300'"
                       class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <p x-show="errors.first_name" class="text-red-500 text-sm mt-1" x-text="errors.first_name"></p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                <input type="text" name="last_name" 
                       value="{{ old('last_name', $newHire->last_name) }}"
                       x-model="formData.last_name"
                       :class="errors.last_name ? 'border-red-500' : 'border-gray-300'"
                       class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <p x-show="errors.last_name" class="text-red-500 text-sm mt-1" x-text="errors.last_name"></p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                <input type="text" name="middle_name" 
                       value="{{ old('middle_name') }}"
                       x-model="formData.middle_name"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name Extension</label>
                <input type="text" name="name_extension" 
                       value="{{ old('name_extension') }}"
                       x-model="formData.name_extension"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth *</label>
                <input type="date" name="date_of_birth" 
                       value="{{ old('date_of_birth') }}"
                       x-model="formData.date_of_birth"
                       :class="errors.date_of_birth ? 'border-red-500' : 'border-gray-300'"
                       class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <p x-show="errors.date_of_birth" class="text-red-500 text-sm mt-1" x-text="errors.date_of_birth"></p>
            </div>
        </div>

        <!-- Contact Info -->
        <h2 class="font-semibold text-lg mb-2">Contact Details</h2>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Home Address</label>
                <input type="text" name="home_address" 
                       value="{{ old('home_address') }}"
                       x-model="formData.home_address"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                <input type="text" name="phone_number" 
                       value="{{ old('phone_number') }}"
                       x-model="formData.phone_number"
                       :class="errors.phone_number ? 'border-red-500' : 'border-gray-300'"
                       class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p x-show="errors.phone_number" class="text-red-500 text-sm mt-1" x-text="errors.phone_number"></p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                <input type="email" name="email" 
                       value="{{ old('email') }}"
                       x-model="formData.email"
                       :class="errors.email ? 'border-red-500' : 'border-gray-300'"
                       class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <p x-show="errors.email" class="text-red-500 text-sm mt-1" x-text="errors.email"></p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact Name</label>
                <input type="text" name="emergency_contact_name" 
                       value="{{ old('emergency_contact_name') }}"
                       x-model="formData.emergency_contact_name"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact Number</label>
                <input type="text" name="emergency_contact_number" 
                       value="{{ old('emergency_contact_number') }}"
                       x-model="formData.emergency_contact_number"
                       :class="errors.emergency_contact_number ? 'border-red-500' : 'border-gray-300'"
                       class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p x-show="errors.emergency_contact_number" class="text-red-500 text-sm mt-1" x-text="errors.emergency_contact_number"></p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Relationship</label>
                <input type="text" name="relationship" 
                       value="{{ old('relationship') }}"
                       x-model="formData.relationship"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <!-- Financial Info -->
        <h2 class="font-semibold text-lg mb-2">Financial Details</h2>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">TIN</label>
                <input type="text" name="tin" 
                       value="{{ old('tin') }}"
                       x-model="formData.tin"
                       :class="errors.tin ? 'border-red-500' : 'border-gray-300'"
                       class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p x-show="errors.tin" class="text-red-500 text-sm mt-1" x-text="errors.tin"></p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">SSS Number</label>
                <input type="text" name="sss_number" 
                       value="{{ old('sss_number') }}"
                       x-model="formData.sss_number"
                       :class="errors.sss_number ? 'border-red-500' : 'border-gray-300'"
                       class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p x-show="errors.sss_number" class="text-red-500 text-sm mt-1" x-text="errors.sss_number"></p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pag-IBIG Number</label>
                <input type="text" name="pagibig_number" 
                       value="{{ old('pagibig_number') }}"
                       x-model="formData.pagibig_number"
                       :class="errors.pagibig_number ? 'border-red-500' : 'border-gray-300'"
                       class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p x-show="errors.pagibig_number" class="text-red-500 text-sm mt-1" x-text="errors.pagibig_number"></p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bank Name</label>
                <input type="text" name="bank_name" 
                       value="{{ old('bank_name') }}"
                       x-model="formData.bank_name"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Account Name</label>
                <input type="text" name="account_name" 
                       value="{{ old('account_name') }}"
                       x-model="formData.account_name"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Account Number</label>
                <input type="text" name="account_number" 
                       value="{{ old('account_number') }}"
                       x-model="formData.account_number"
                       :class="errors.account_number ? 'border-red-500' : 'border-gray-300'"
                       class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p x-show="errors.account_number" class="text-red-500 text-sm mt-1" x-text="errors.account_number"></p>
            </div>
        </div>

        <!-- Job Information -->
        <h2 class="font-semibold text-lg mb-2">Job Information</h2>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Start Date *</label>
                <input type="date" name="start_date" 
                       value="{{ old('start_date') }}"
                       x-model="formData.start_date"
                       :class="errors.start_date ? 'border-red-500' : 'border-gray-300'"
                       class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <p x-show="errors.start_date" class="text-red-500 text-sm mt-1" x-text="errors.start_date"></p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Department *</label>
                <select name="department" 
                        x-model="formData.department"
                        :class="errors.department ? 'border-red-500' : 'border-gray-300'"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select Department</option>
                    <option value="Front Office" {{ old('department', $newHire->department) == 'Front Office' ? 'selected' : '' }}>Front Office</option>
                    <option value="Housekeeping" {{ old('department', $newHire->department) == 'Housekeeping' ? 'selected' : '' }}>Housekeeping</option>
                    <option value="Food & Beverage" {{ old('department', $newHire->department) == 'Food & Beverage' ? 'selected' : '' }}>Food & Beverage</option>
                    <option value="Kitchen" {{ old('department', $newHire->department) == 'Kitchen' ? 'selected' : '' }}>Kitchen</option>
                    <option value="Sales & Marketing" {{ old('department', $newHire->department) == 'Sales & Marketing' ? 'selected' : '' }}>Sales & Marketing</option>
                    <option value="Finance" {{ old('department', $newHire->department) == 'Finance' ? 'selected' : '' }}>Finance</option>
                    <option value="Human Resources" {{ old('department', $newHire->department) == 'Human Resources' ? 'selected' : '' }}>Human Resources</option>
                    <option value="IT" {{ old('department', $newHire->department) == 'IT' ? 'selected' : '' }}>IT</option>
                    <option value="Maintenance" {{ old('department', $newHire->department) == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="Security" {{ old('department', $newHire->department) == 'Security' ? 'selected' : '' }}>Security</option>
                    <option value="Spa & Wellness" {{ old('department', $newHire->department) == 'Spa & Wellness' ? 'selected' : '' }}>Spa & Wellness</option>
                </select>
                <p x-show="errors.department" class="text-red-500 text-sm mt-1" x-text="errors.department"></p>
            </div>
            
<!-- Job Title - Use job_category instead of job_title -->
<div>
    <label class="block text-gray-700 font-medium mb-1">Job Title *</label>
    <input type="text" name="job_category" 
        value="{{ old('job_category', $newHire->position_applied) }}"
        class="w-full border rounded-lg p-2 @error('job_category') border-red-500 @enderror" 
        required
        maxlength="100">
    @error('job_category')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Employment Type</label>
                <select name="employment_type" 
                        x-model="formData.employment_type"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Employment Type</option>
                    <option value="Full-time" {{ old('employment_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ old('employment_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="Contract" {{ old('employment_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                    <option value="Seasonal" {{ old('employment_type') == 'Seasonal' ? 'selected' : '' }}>Seasonal</option>
                    <option value="Temporary" {{ old('employment_type') == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                    <option value="Internship" {{ old('employment_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Reporting Manager *</label>
                <input type="text" name="reporting_manager" 
                       value="{{ old('reporting_manager') }}"
                       x-model="formData.reporting_manager"
                       :class="errors.reporting_manager ? 'border-red-500' : 'border-gray-300'"
                       placeholder="Enter reporting manager's name"
                       class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <p x-show="errors.reporting_manager" class="text-red-500 text-sm mt-1" x-text="errors.reporting_manager"></p>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end space-x-4">
            <button type="button" @click="clearForm" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200 font-medium">
                Clear Form
            </button>
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200 font-medium">
                Create Employee Profile
            </button>
        </div>
    </form>

    <!-- Confirmation Modal -->
    <div x-cloak x-show="showConfirmation" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Confirm Employee Creation</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to create the employee profile for <span x-text="formData.first_name + ' ' + formData.last_name" class="font-semibold"></span>?</p>
            <div class="flex justify-end space-x-3">
                <button @click="showConfirmation = false" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</button>
                <button @click="submitForm" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Confirm</button>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div x-cloak x-show="showToast" x-transition 
         class="fixed top-5 right-5 px-6 py-4 rounded-lg shadow-lg z-50"
         :class="toastType === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'">
        <div class="flex items-center space-x-3">
            <span x-text="toastMessage"></span>
            <button @click="showToast = false" class="text-white hover:text-gray-200">✖</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function employeeForm() {
    return {
        formData: {
            first_name: '{{ old('first_name', $newHire->first_name) }}',
            last_name: '{{ old('last_name', $newHire->last_name) }}',
            middle_name: '{{ old('middle_name') }}',
            name_extension: '{{ old('name_extension') }}',
            date_of_birth: '{{ old('date_of_birth') }}',
            home_address: '{{ old('home_address') }}',
            phone_number: '{{ old('phone_number') }}',
            email: '{{ old('email') }}',
            emergency_contact_name: '{{ old('emergency_contact_name') }}',
            emergency_contact_number: '{{ old('emergency_contact_number') }}',
            relationship: '{{ old('relationship') }}',
            tin: '{{ old('tin') }}',
            sss_number: '{{ old('sss_number') }}',
            pagibig_number: '{{ old('pagibig_number') }}',
            bank_name: '{{ old('bank_name') }}',
            account_name: '{{ old('account_name') }}',
            account_number: '{{ old('account_number') }}',
            start_date: '{{ old('start_date') }}',
            department: '{{ old('department', $newHire->department ?? '') }}',
            job_category: '{{ old('job_category', $newHire->position_applied ?? '') }}',
            employment_type: '{{ old('employment_type') }}',
            reporting_manager: '{{ old('reporting_manager') }}'
        },
        errors: {},
        showConfirmation: false,
        showToast: false,
        toastMessage: '',
        toastType: 'success',
        loading: false,

        init() {
            // Initialize form data from the actual input values
            // This ensures the pre-filled values from PHP are captured
            const form = document.getElementById('employeeForm');
            const formData = new FormData(form);
            
            // Update Alpine.js data with the actual pre-filled values
            for (let [key, value] of formData.entries()) {
                if (this.formData.hasOwnProperty(key)) {
                    this.formData[key] = value;
                }
            }
        },

        validateForm() {
            this.errors = {};

            // Required fields validation
            if (!this.formData.first_name?.trim()) this.errors.first_name = 'First name is required';
            if (!this.formData.last_name?.trim()) this.errors.last_name = 'Last name is required';
            if (!this.formData.date_of_birth) this.errors.date_of_birth = 'Date of birth is required';
            if (!this.formData.email?.trim()) this.errors.email = 'Email is required';
            if (!this.formData.start_date) this.errors.start_date = 'Start date is required';
            if (!this.formData.department) this.errors.department = 'Department is required';
            if (!this.formData.job_category?.trim()) this.errors.job_category = 'Job position is required';
            if (!this.formData.reporting_manager?.trim()) this.errors.reporting_manager = 'Reporting manager is required';

            // Email validation
            if (this.formData.email && !this.isValidEmail(this.formData.email)) {
                this.errors.email = 'Please enter a valid email address';
            }

            // Phone number validation
            if (this.formData.phone_number && !this.isValidPhone(this.formData.phone_number)) {
                this.errors.phone_number = 'Please enter a valid phone number';
            }

            // Emergency contact number validation
            if (this.formData.emergency_contact_number && !this.isValidPhone(this.formData.emergency_contact_number)) {
                this.errors.emergency_contact_number = 'Please enter a valid emergency contact number';
            }

            // TIN validation (9-12 digits)
            if (this.formData.tin && !this.isValidTIN(this.formData.tin)) {
                this.errors.tin = 'TIN must be 9-12 digits';
            }

            // SSS validation (10 digits)
            if (this.formData.sss_number && !this.isValidSSS(this.formData.sss_number)) {
                this.errors.sss_number = 'SSS number must be 10 digits';
            }

            // Pag-IBIG validation (12 digits)
            if (this.formData.pagibig_number && !this.isValidPagIBIG(this.formData.pagibig_number)) {
                this.errors.pagibig_number = 'Pag-IBIG number must be 12 digits';
            }

            // Account number validation (no negative numbers)
            if (this.formData.account_number && !this.isValidAccountNumber(this.formData.account_number)) {
                this.errors.account_number = 'Account number cannot contain negative numbers';
            }

            // Date validation (cannot be in the future for date of birth)
            if (this.formData.date_of_birth && new Date(this.formData.date_of_birth) > new Date()) {
                this.errors.date_of_birth = 'Date of birth cannot be in the future';
            }

            // Start date validation (cannot be in the past)
            if (this.formData.start_date && new Date(this.formData.start_date) < new Date().setHours(0,0,0,0)) {
                this.errors.start_date = 'Start date cannot be in the past';
            }

            if (Object.keys(this.errors).length === 0) {
                this.showConfirmation = true;
            }
        },

        async submitForm() {
            this.showConfirmation = false;
            this.loading = true;

            try {
                const form = document.getElementById('employeeForm');
                const formData = new FormData(form);

                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    this.showToastMessage('Employee profile created successfully!', 'success');
                    setTimeout(() => {
                        window.location.href = '{{ route("employees.index") }}';
                    }, 2000);
                } else {
                    if (data.errors) {
                        this.errors = data.errors;
                        // Show specific backend validation errors
                        if (data.errors.email) {
                            this.showToastMessage(data.errors.email[0], 'error');
                        }
                        if (data.errors.tin) {
                            this.showToastMessage(data.errors.tin[0], 'error');
                        }
                        if (data.errors.sss_number) {
                            this.showToastMessage(data.errors.sss_number[0], 'error');
                        }
                        if (data.errors.pagibig_number) {
                            this.showToastMessage(data.errors.pagibig_number[0], 'error');
                        }
                    } else {
                        this.showToastMessage(data.message || 'An error occurred', 'error');
                    }
                }
            } catch (error) {
                this.showToastMessage('Network error. Please try again.', 'error');
            } finally {
                this.loading = false;
            }
        },

        clearForm() {
            if (confirm('Are you sure you want to clear all form data?')) {
                // Reset to original pre-filled values from new hire
                this.formData = {
                    first_name: '{{ $newHire->first_name }}',
                    last_name: '{{ $newHire->last_name }}',
                    middle_name: '',
                    name_extension: '',
                    date_of_birth: '',
                    home_address: '',
                    phone_number: '',
                    email: '',
                    emergency_contact_name: '',
                    emergency_contact_number: '',
                    relationship: '',
                    tin: '',
                    sss_number: '',
                    pagibig_number: '',
                    bank_name: '',
                    account_name: '',
                    account_number: '',
                    start_date: '',
                    department: '{{ $newHire->department ?? '' }}',
                    job_category: '{{ $newHire->position_applied ?? '' }}',
                    employment_type: '',
                    reporting_manager: ''
                };
                this.errors = {};
            }
        },

        showToastMessage(message, type) {
            this.toastMessage = message;
            this.toastType = type;
            this.showToast = true;
            setTimeout(() => {
                this.showToast = false;
            }, 5000);
        },

        // Validation helper functions
        isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        },

        isValidPhone(phone) {
            return /^[\d\s\-\+\(\)]{7,15}$/.test(phone.replace(/\s/g, ''));
        },

        isValidTIN(tin) {
            return /^\d{9,12}$/.test(tin.replace(/\D/g, ''));
        },

        isValidSSS(sss) {
            return /^\d{10}$/.test(sss.replace(/\D/g, ''));
        },

        isValidPagIBIG(pagibig) {
            return /^\d{12}$/.test(pagibig.replace(/\D/g, ''));
        },

        isValidAccountNumber(account) {
            return !/-/.test(account) && !/^\d+$/.test(account) ? false : true;
        }
    };
}
</script>
@endpush
@endsection