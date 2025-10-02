@extends('layouts.app')

@section('page-title', 'Employee Management')
@section('page-subtitle', 'Manage your employees and their information')

@section('content')

@include('employees.termination-modal')

<!-- Stats Cards -->
{{-- <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-4">
    <!-- Total Employees -->
    <div class="bg-white rounded-lg shadow-sm border p-6">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-lg">
                <i class="text-blue-600 fas fa-users text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Employees</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Employee::count() }}</p>
            </div>
        </div>
    </div>

    <!-- New Hires -->
    <div class="bg-white rounded-lg shadow-sm border p-6">
        <div class="flex items-center">
            <div class="p-3 bg-orange-100 rounded-lg">
                <i class="text-orange-600 fas fa-user-plus text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">New Hires</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\NewHire::count() }}</p>
            </div>
        </div>
    </div>
</div> --}}

<!-- Header with Filters and Add Button -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 space-y-4 lg:space-y-0">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">Employee List</h2>
        <p class="text-gray-600">Showing all employees</p>
    </div>
    
    <!-- Filters -->
    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
        <div class="relative">
            <select id="departmentFilter" onchange="filterEmployees()" class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm w-48">
                <option value="">All Departments</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept }}">{{ $dept }}</option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <i class="fas fa-chevron-down text-xs"></i>
            </div>
        </div>

        <div class="relative">
            <select id="jobFilter" onchange="filterEmployees()" class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm w-48">
                <option value="">All Job Titles</option>
                @foreach($jobTitles as $job)
                    <option value="{{ $job }}">{{ $job }}</option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <i class="fas fa-chevron-down text-xs"></i>
            </div>
        </div>

        <div class="relative">
            <select id="employmentTypeFilter" onchange="filterEmployees()" class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm w-40">
                <option value="">All Employment Types</option>
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
                <option value="Contract">Contract</option>
                <option value="Temporary">Temporary</option>
                <option value="Internship">Internship</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <i class="fas fa-chevron-down text-xs"></i>
            </div>
        </div>

        <button onclick="clearFilters()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 text-sm flex items-center space-x-2">
            <i class="fas fa-times"></i>
            <span>Clear</span>
        </button>
    </div>

    <!-- Add New Hire Button -->
    <a href="{{ route('newhires.index') }}" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition duration-200 flex items-center space-x-2">
        <i class="fas fa-user-plus"></i>
        <span>Add New Hire</span>
    </a>
</div>

@if(session('success'))
    <div class="p-4 mb-6 text-green-700 bg-green-100 rounded-lg border border-green-200 flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        {{ session('success') }}
    </div>
@endif

<!-- Employees Table -->
<div class="bg-white rounded-lg shadow-sm border overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Department</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Job Title</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Start Date</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" id="employeeTableBody">
                @foreach($employees as $employee)
                    @php
                        $fullname = trim($employee->first_name.' '.$employee->middle_name.' '.$employee->last_name.' '.$employee->name_extension);
                    @endphp
                    <tr class="employee-row hover:bg-gray-50 transition duration-150" 
                        data-department="{{ $employee->department }}"
                        data-job="{{ $employee->job_category }}"
                        data-status="{{ $employee->employee_status ?? 'Full-time' }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $employee->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $fullname }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $employee->department }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $employee->job_category }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $employee->start_date ? date('d/m/Y', strtotime($employee->start_date)) : 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $employee->employee_status ?? 'Full-time' }}
                            </span>
<td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-3">
    <a href="{{ route('employees.view', $employee->id) }}" class="text-blue-600 hover:text-blue-900" title="View">
        <i class="fas fa-eye text-lg"></i>
    </a>
    <a href="{{ route('employees.edit', $employee->id) }}" class="text-green-600 hover:text-green-900" title="Edit">
        <i class="fas fa-edit text-lg"></i>
    </a>
    @if(auth()->user()->role === 'admin')
        <button onclick="openTerminationModal({{ $employee->id }})" class="text-red-600 hover:text-red-900" title="Terminate">
            <i class="fas fa-trash text-lg"></i>
        </button>
    @endif
</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 border-t bg-gray-50 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Showing {{ $employees->firstItem() ?? 0 }} to {{ $employees->lastItem() ?? 0 }} of {{ $employees->total() }} results
        </div>
        <div class="flex space-x-2">
            @if($employees->onFirstPage())
                <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded">Previous</span>
            @else
                <a href="{{ $employees->previousPageUrl() }}" class="px-3 py-1 text-blue-600 bg-white border border-gray-300 rounded hover:bg-gray-50">Previous</a>
            @endif
            
            @if($employees->hasMorePages())
                <a href="{{ $employees->nextPageUrl() }}" class="px-3 py-1 text-blue-600 bg-white border border-gray-300 rounded hover:bg-gray-50">Next</a>
            @else
                <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded">Next</span>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Filter function
function filterEmployees() {
    const department = document.getElementById('departmentFilter').value;
    const jobTitle = document.getElementById('jobFilter').value;
    const employmentType = document.getElementById('employmentTypeFilter').value;
    
    const rows = document.querySelectorAll('.employee-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const rowDept = row.getAttribute('data-department');
        const rowJob = row.getAttribute('data-job');
        const rowStatus = row.getAttribute('data-status');
        
        const deptMatch = !department || rowDept === department;
        const jobMatch = !jobTitle || rowJob === jobTitle;
        const statusMatch = !employmentType || rowStatus === employmentType;
        
        if (deptMatch && jobMatch && statusMatch) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    const showingElement = document.querySelector('.text-gray-700');
    if (showingElement) {
        const total = {{ $employees->total() }};
        showingElement.textContent = `Showing ${visibleCount} of ${total} employees`;
    }
}

function clearFilters() {
    document.getElementById('departmentFilter').value = '';
    document.getElementById('jobFilter').value = '';
    document.getElementById('employmentTypeFilter').value = '';
    filterEmployees();
}

document.addEventListener('DOMContentLoaded', function() {
    filterEmployees();
});

// Termination modal function
function openTerminationModal(employeeId) {
    const modal = document.getElementById('terminationModal');
    const form = document.getElementById('terminationForm');
    form.action = `/terminations/store/${employeeId}`;
    modal.classList.remove('hidden');
}
function closeTerminationModal() {
    document.getElementById('terminationModal').classList.add('hidden');
}

// Edit modal function
function openEditModal(employee) {
    // Populate edit modal fields here
    const modal = document.getElementById('editModal');
    modal.querySelector('[name="first_name"]').value = employee.first_name;
    modal.querySelector('[name="last_name"]').value = employee.last_name;
    modal.querySelector('[name="department"]').value = employee.department;
    modal.querySelector('[name="job_category"]').value = employee.job_category;
    modal.querySelector('[name="start_date"]').value = employee.start_date;
    modal.querySelector('[name="employee_status"]').value = employee.employee_status;
    modal.querySelector('form').action = `/employees/${employee.id}/update`;
    modal.classList.remove('hidden');
}
function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>
@endpush
