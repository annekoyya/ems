@extends('layouts.app')

@section('page-title', 'Edit Employee')
@section('page-subtitle', 'Update employee information')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-6">Edit Employee</h2>

    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
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
                <label class="block text-gray-700 font-medium mb-1">First Name <span class="text-red-500">*</span></label>
                <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name) }}"
                    class="w-full border-gray-300 rounded-lg @error('first_name') border-red-500 @enderror">
                @error('first_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Last Name -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Last Name <span class="text-red-500">*</span></label>
                <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}"
                    class="w-full border-gray-300 rounded-lg @error('last_name') border-red-500 @enderror">
                @error('last_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Middle Name -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Middle Name</label>
                <input type="text" name="middle_name" value="{{ old('middle_name', $employee->middle_name) }}"
                    class="w-full border-gray-300 rounded-lg">
            </div>

            <!-- Name Extension -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Name Extension</label>
                <input type="text" name="name_extension" value="{{ old('name_extension', $employee->name_extension) }}"
                    class="w-full border-gray-300 rounded-lg">
            </div>

            <!-- Email (unique) -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email', $employee->email) }}"
                    class="w-full border-gray-300 rounded-lg @error('email') border-red-500 @enderror">
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

            <!-- Department -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Department <span class="text-red-500">*</span></label>
                <input type="text" name="department" value="{{ old('department', $employee->department) }}"
                    class="w-full border-gray-300 rounded-lg @error('department') border-red-500 @enderror">
                @error('department')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Job Category -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Job Category</label>
                <input type="text" name="job_category" value="{{ old('job_category', $employee->job_category) }}"
                    class="w-full border-gray-300 rounded-lg">
            </div>

            <!-- Reporting Manager -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Reporting Manager <span class="text-red-500">*</span></label>
                <input type="text" name="reporting_manager" value="{{ old('reporting_manager', $employee->reporting_manager) }}"
                    class="w-full border-gray-300 rounded-lg @error('reporting_manager') border-red-500 @enderror">
                @error('reporting_manager')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone Number -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Phone Number</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $employee->phone_number) }}"
                    class="w-full border-gray-300 rounded-lg">
            </div>

            <!-- Home Address -->
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-medium mb-1">Home Address</label>
                <textarea name="home_address" rows="3"
                    class="w-full border-gray-300 rounded-lg">{{ old('home_address', $employee->home_address) }}</textarea>
            </div>

            <!-- Bank Details (optional) -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Bank Name</label>
                <input type="text" name="bank_name" value="{{ old('bank_name', $employee->bank_name) }}"
                    class="w-full border-gray-300 rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Account Number</label>
                <input type="text" name="account_number" value="{{ old('account_number', $employee->account_number) }}"
                    class="w-full border-gray-300 rounded-lg">
            </div>
        </div>

        <!-- Submit -->
        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('employees.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>
@endsection
