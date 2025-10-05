<!-- View Employee Modal -->
<div id="viewModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-xl shadow-lg w-11/12 md:w-3/4 lg:w-1/2 max-h-[90vh] overflow-y-auto p-6 relative">
        <!-- Close button -->
        <button onclick="closeViewModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-900 text-2xl font-bold">&times;</button>

        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Employee Details</h2>

        <div id="viewContent" class="space-y-2 text-gray-700 text-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <p><strong>Full Name:</strong> <span id="viewFullname"></span></p>
                <p><strong>Department:</strong> <span id="viewDepartment"></span></p>
                <p><strong>Job Category:</strong> <span id="viewJobCategory"></span></p>
                <p><strong>Employment Type:</strong> <span id="viewEmploymentType"></span></p>
                <p><strong>Reporting Manager:</strong> <span id="viewManager"></span></p>
                <p><strong>Date of Birth:</strong> <span id="viewDOB"></span></p>
                <p><strong>Email:</strong> <span id="viewEmail"></span></p>
                <p><strong>Phone Number:</strong> <span id="viewPhone"></span></p>
                <p><strong>Home Address:</strong> <span id="viewAddress"></span></p>
                <p><strong>Emergency Contact:</strong> <span id="viewEmergency"></span></p>
                <p><strong>TIN:</strong> <span id="viewTIN"></span></p>
                <p><strong>SSS Number:</strong> <span id="viewSSS"></span></p>
                <p><strong>PAG-IBIG Number:</strong> <span id="viewPagibig"></span></p>
                <p><strong>Bank Name:</strong> <span id="viewBank"></span></p>
                <p><strong>Account Name:</strong> <span id="viewAccountName"></span></p>
                <p><strong>Account Number:</strong> <span id="viewAccountNumber"></span></p>
                <p><strong>Start Date:</strong> <span id="viewStartDate"></span></p>
            </div>
        </div>

        <div class="mt-4 flex justify-end space-x-2">
            <button onclick="printEmployee()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Generate Print</button>
            <button onclick="closeViewModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">Close</button>
        </div>
    </div>
</div>

<script>
function openViewModal(employee) {
    document.getElementById('viewFullname').innerText = `${employee.first_name} ${employee.middle_name ?? ''} ${employee.last_name} ${employee.name_extension ?? ''}`;
    document.getElementById('viewDepartment').innerText = employee.department;
    document.getElementById('viewJobCategory').innerText = employee.job_category ?? '-';
    document.getElementById('viewEmploymentType').innerText = employee.employment_type ?? '-';
    document.getElementById('viewManager').innerText = employee.reporting_manager ?? '-';
    document.getElementById('viewDOB').innerText = employee.date_of_birth ?? '-';
    document.getElementById('viewEmail').innerText = employee.email ?? '-';
    document.getElementById('viewPhone').innerText = employee.phone_number ?? '-';
    document.getElementById('viewAddress').innerText = employee.home_address ?? '-';
    document.getElementById('viewEmergency').innerText = employee.emergency_contact_name ? `${employee.emergency_contact_name} (${employee.relationship ?? '-'})` : '-';
    document.getElementById('viewTIN').innerText = employee.tin ?? '-';
    document.getElementById('viewSSS').innerText = employee.sss_number ?? '-';
    document.getElementById('viewPagibig').innerText = employee.pagibig_number ?? '-';
    document.getElementById('viewBank').innerText = employee.bank_name ?? '-';
    document.getElementById('viewAccountName').innerText = employee.account_name ?? '-';
    document.getElementById('viewAccountNumber').innerText = employee.account_number ?? '-';
    document.getElementById('viewStartDate').innerText = employee.start_date ?? '-';

    document.getElementById('viewModal').classList.remove('hidden');
}

function closeViewModal() {
    document.getElementById('viewModal').classList.add('hidden');
}

function printEmployee() {
    const content = document.getElementById('viewContent').innerHTML;
    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Employee Details</title></head><body>');
    printWindow.document.write(content);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}
</script>
