{{-- @extends('layouts.app') --}}

@section('page-title', 'Employee Details')
@section('page-subtitle', 'Full information for '.$employee->first_name.' '.$employee->last_name)

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6">Employee Details</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
        <p><strong>Full Name:</strong> {{ $employee->first_name }} {{ $employee->middle_name ?? '' }} {{ $employee->last_name }} {{ $employee->name_extension ?? '' }}</p>
        <p><strong>Date of Birth:</strong> {{ $employee->date_of_birth ? date('d/m/Y', strtotime($employee->date_of_birth)) : 'N/A' }}</p>
        <p><strong>Email:</strong> {{ $employee->email }}</p>
        <p><strong>Phone Number:</strong> {{ $employee->phone_number ?? '-' }}</p>
        <p><strong>Address:</strong> {{ $employee->home_address ?? '-' }}</p>
        <p><strong>Emergency Contact:</strong> {{ $employee->emergency_contact_name ?? '-' }} ({{ $employee->emergency_contact_number ?? '-' }})</p>
        <p><strong>Relationship:</strong> {{ $employee->relationship ?? '-' }}</p>

        <p><strong>TIN:</strong> {{ $employee->tin ?? '-' }}</p>
        <p><strong>SSS Number:</strong> {{ $employee->sss_number ?? '-' }}</p>
        <p><strong>Pag-IBIG Number:</strong> {{ $employee->pagibig_number ?? '-' }}</p>
        <p><strong>Bank Name:</strong> {{ $employee->bank_name ?? '-' }}</p>
        <p><strong>Account Name:</strong> {{ $employee->account_name ?? '-' }}</p>
        <p><strong>Account Number:</strong> {{ $employee->account_number ?? '-' }}</p>

        <p><strong>Department:</strong> {{ $employee->department }}</p>
        <p><strong>Job Category:</strong> {{ $employee->job_category ?? '-' }}</p>
        <p><strong>Employment Type:</strong> {{ $employee->employment_type ?? '-' }}</p>
        <p><strong>Start Date:</strong> {{ $employee->start_date ? date('d/m/Y', strtotime($employee->start_date)) : 'N/A' }}</p>
        <p><strong>Reporting Manager:</strong> {{ $employee->reporting_manager }}</p>
    </div>

    <div class="mt-6 flex space-x-3">
        <a href="{{ route('employees.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Back</a>
        <a href="{{ route('employees.pdf', $employee->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Generate PDF</a>
    </div>
</div>
@endsection
