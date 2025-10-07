@extends('layouts.app')

@section('page-title', 'Employee Management')
@section('page-subtitle', 'Manage your employees and their information')

@section('content')

@include('employees.termination-modal')

<!-- Header with Filters and Add Button -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 space-y-4 lg:space-y-0">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">Employee List</h2>
        <p class="text-gray-600">Showing all emploees</p>
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
                        $status = $employee->employment_type ?? 'Full-time';
                        $statusColor = match($status) {
                            'Full-time' => 'bg-green-100 text-green-800',
                            'Part-time' => 'bg-blue-100 text-blue-800',
                            'Contract' => 'bg-purple-100 text-purple-800',
                            'Temporary' => 'bg-yellow-100 text-yellow-800',
                            'Internship' => 'bg-gray-100 text-gray-800',
                            default => 'bg-gray-100 text-gray-800'
                        };
                    @endphp
                    <tr class="employee-row hover:bg-gray-50 transition duration-150" 
                        data-department="{{ $employee->department }}"
                        data-job="{{ $employee->job_category }}"
                        data-status="{{ $status }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $employee->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $fullname }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $employee->department }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $employee->job_category }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $employee->start_date ? date('d/m/Y', strtotime($employee->start_date)) : 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                {{ $status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-3">
                            <a href="{{ route('employees.view', $employee->id) }}" class="text-blue-600 hover:text-blue-900" title="View">
                                <i class="fas fa-eye text-lg"></i>
                            </a>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="text-green-600 hover:text-green-900" title="Edit">
                                <i class="fas fa-edit text-lg"></i>
                            </a>
                            <button
                                type="button"
                                class="open-termination-btn text-red-600 hover:text-red-800"
                                data-employee-id="{{ $employee->id }}"
                                data-employee-name="{{ $employee->first_name }} {{ $employee->last_name }}"
                                data-employee-date="{{ optional($employee->created_at)->format('Y-m-d') ?? now()->format('Y-m-d') }}"
                                title="Terminate"
                            >
                                <i class="fas fa-trash text-lg"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Results Count (replaces pagination) -->
    <div class="px-6 py-4 border-t bg-gray-50">
        <div class="text-sm text-gray-700" id="resultsCount">
            Showing {{ count($employees) }} employees
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // --------------------------
    // Filter functions
    // --------------------------
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

        // Update results count
        const resultsCount = document.getElementById('resultsCount');
        if (resultsCount) {
            resultsCount.textContent = `Showing ${visibleCount} employees`;
        }
    }

    function clearFilters() {
        document.getElementById('departmentFilter').value = '';
        document.getElementById('jobFilter').value = '';
        document.getElementById('employmentTypeFilter').value = '';
        filterEmployees();
    }

    // --------------------------
    // Termination modal
    // --------------------------
    document.addEventListener('click', function(e) {
        // Open termination modal
        const btn = e.target.closest('.open-termination-btn');
        if (btn) {
            const id = btn.dataset.employeeId;
            const name = btn.dataset.employeeName || 'Unknown';
            const date = btn.dataset.employeeDate || new Date().toISOString().split('T')[0];

            document.getElementById('terminationEmployeeId').innerText = id;
            document.getElementById('terminationEmployeeName').innerText = name;
            document.getElementById('terminationSubmissionDate').innerText = date;

            const terminationForm = document.getElementById('terminationForm');
            terminationForm.action = `/terminations/store/${id}`;
            terminationForm.reset();

            document.getElementById('dateError').classList.add('hidden');
            document.getElementById('reasonError').classList.add('hidden');
            document.getElementById('checkboxError').classList.add('hidden');

            document.getElementById('terminationModal').classList.remove('hidden');
        }

        // Close termination modal
        if (e.target.id === 'terminationCloseBtn') {
            document.getElementById('terminationModal').classList.add('hidden');
        }

        // Close confirm modal
        if (e.target.id === 'confirmCancelBtn') {
            document.getElementById('confirmTerminationModal').classList.add('hidden');
        }

        // Validate termination modal
        if (e.target.id === 'terminationValidateBtn') {
            const today = new Date().toISOString().split('T')[0];
            const lastWorkingDay = document.getElementById('lastWorkingDay').value;
            const reason = document.getElementById('reason').value.trim();

            const documentation = document.getElementById('documentation').checked;
            const exitInterview = document.getElementById('exitInterview').checked;
            const clearance = document.getElementById('clearanceForm').checked;
            const finalPay = document.getElementById('finalPayAck').checked;

            let valid = true;

            // Last working day validation
            if (!lastWorkingDay || lastWorkingDay < today) {
                document.getElementById('dateError').classList.remove('hidden');
                valid = false;
            } else {
                document.getElementById('dateError').classList.add('hidden');
            }

            // Reason validation
            if (!reason) {
                document.getElementById('reasonError').classList.remove('hidden');
                valid = false;
            } else {
                document.getElementById('reasonError').classList.add('hidden');
            }

            // **All checkboxes must be checked**
            if (!documentation || !exitInterview || !clearance || !finalPay) {
                document.getElementById('checkboxError').classList.remove('hidden');
                valid = false;
            } else {
                document.getElementById('checkboxError').classList.add('hidden');
            }

            if (valid) {
                document.getElementById('confirmEmployeeName').innerText = document.getElementById('terminationEmployeeName').innerText;
                document.getElementById('confirmEmployeeId').innerText = document.getElementById('terminationEmployeeId').innerText;
                document.getElementById('confirmTerminationModal').classList.remove('hidden');
            }
        }

        // Final submit
        if (e.target.id === 'confirmSubmitBtn') {
            const confirmSubmitBtn = document.getElementById('confirmSubmitBtn');
            confirmSubmitBtn.disabled = true;
            document.getElementById('terminationForm').submit();
        }
    });

    // Initialize filters on page load
    document.addEventListener('DOMContentLoaded', function() {
        filterEmployees();
    });
</script>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in { animation: fade-in 0.4s ease-out; }
</style>
@endpush