<!-- employees/edit-modal.blade.php -->
<div id="editEmployeeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-6 overflow-y-auto max-h-[90vh]">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Edit Employee Profile</h2>
            <button onclick="closeEditModal()" class="text-gray-600 hover:text-gray-900">&times;</button>
        </div>

        <form id="editEmployeeForm" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- Personal Info -->
                <div>
                    <label class="block font-medium">First Name</label>
                    <input type="text" name="first_name" class="border rounded w-full p-2" required>
                </div>

                <div>
                    <label class="block font-medium">Last Name</label>
                    <input type="text" name="last_name" class="border rounded w-full p-2" required>
                </div>

                <div>
                    <label class="block font-medium">Middle Name</label>
                    <input type="text" name="middle_name" class="border rounded w-full p-2">
                </div>

                <div>
                    <label class="block font-medium">Name Extension</label>
                    <input type="text" name="name_extension" class="border rounded w-full p-2">
                </div>

                <div>
                    <label class="block font-medium">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="border rounded w-full p-2" required>
                </div>

                <!-- Contact Info -->
                <div>
                    <label class="block font-medium">Home Address</label>
                    <input type="text" name="home_address" class="border rounded w-full p-2">
                </div>

                <div>
                    <label class="block font-medium">Phone Number</label>
                    <input type="text" name="phone_number" class="border rounded w-full p-2">
                </div>

                <div>
                    <label class="block font-medium">Email</label>
                    <input type="email" name="email" class="border rounded w-full p-2" required>
                </div>

                <div>
                    <label class="block font-medium">Emergency Contact Name</label>
                    <input type="text" name="emergency_contact_name" class="border rounded w-full p-2">
                </div>

                <div>
                    <label class="block font-medium">Emergency Contact Number</label>
                    <input type="text" name="emergency_contact_number" class="border rounded w-full p-2">
                </div>

                <div>
                    <label class="block font-medium">Relationship</label>
                    <input type="text" name="relationship" class="border rounded w-full p-2">
                </div>

                <!-- Financial -->
                <div>
                    <label class="block font-medium">TIN</label>
                    <input type="text" name="tin" class="border rounded w-full p-2">
                </div>

                <div>
                    <label class="block font-medium">SSS Number</label>
                    <input type="text" name="sss_number" class="border rounded w-full p-2">
                </div>

                <div>
                    <label class="block font-medium">Pag-IBIG Number</label>
                    <input type="text" name="pagibig_number" class="border rounded w-full p-2">
                </div>

                <div>
                    <label class="block font-medium">Bank Name</label>
                    <input type="text" name="bank_name" class="border rounded w-full p-2">
                </div>

                <div>
                    <label class="block font-medium">Account Name</label>
                    <input type="text" name="account_name" class="border rounded w-full p-2">
                </div>

                <div>
                    <label class="block font-medium">Account Number</label>
                    <input type="text" name="account_number" class="border rounded w-full p-2">
                </div>

                <!-- Job Info -->
                <div>
                    <label class="block font-medium">Start Date</label>
                    <input type="date" name="start_date" class="border rounded w-full p-2" required>
                </div>

                <div>
                    <label class="block font-medium">Department</label>
                    <input type="text" name="department" class="border rounded w-full p-2" required>
                </div>

                <div>
                    <label class="block font-medium">Job Category</label>
                    <input type="text" name="job_category" class="border rounded w-full p-2">
                </div>

                <div>
                    <label class="block font-medium">Employment Type</label>
                    <input type="text" name="employment_type" class="border rounded w-full p-2">
                </div>

                <div>
                    <label class="block font-medium">Reporting Manager</label>
                    <input type="text" name="reporting_manager" class="border rounded w-full p-2" required>
                </div>

            </div>

            <div class="flex justify-end mt-6 space-x-3">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Update</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openEditModal(employee) {
    const modal = document.getElementById('editEmployeeModal');
    const form = document.getElementById('editEmployeeForm');

    // Populate form fields
    for (const key in employee) {
        if (form[key]) {
            form[key].value = employee[key] ?? '';
        }
    }

    // Set form action dynamically
    form.action = `/employees/${employee.id}`;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditModal() {
    const modal = document.getElementById('editEmployeeModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endpush
