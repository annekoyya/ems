<!-- Termination Modal -->
<div id="terminationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
        <button onclick="closeTerminationModal()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">&times;</button>
        <h2 class="text-xl font-bold mb-4">Terminate Employee</h2>

        <form id="terminationForm" method="POST">
            @csrf
            <div class="mb-3">
                <label class="block font-medium">Last Working Day</label>
                <input type="date" name="last_working_day" class="border rounded w-full p-2" required>
            </div>

            <div class="mb-3">
                <label class="block font-medium">Reason for Leaving</label>
                <textarea name="reason" class="border rounded w-full p-2" required></textarea>
            </div>

            <div class="mb-3">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="documentation" class="form-checkbox">
                    <span class="ml-2">Documentation & Compliance</span>
                </label>
            </div>

            <div class="mb-3">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="exit_interview" class="form-checkbox">
                    <span class="ml-2">Exit Interview</span>
                </label>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Required Paperwork</label>
                <label class="inline-flex items-center mr-4">
                    <input type="checkbox" name="clearance_form" class="form-checkbox">
                    <span class="ml-2">Clearance Form</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="final_pay_ack" class="form-checkbox">
                    <span class="ml-2">Final Pay Acknowledgment</span>
                </label>
            </div>

            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 w-full">Terminate Employee</button>
        </form>
    </div>
</div>

<script>
function openTerminationModal(employeeId) {
    const modal = document.getElementById('terminationModal');
    const form = document.getElementById('terminationForm');
    // Update form action dynamically
    form.action = `/terminations/store/${employeeId}`;
    modal.classList.remove('hidden');
}

function closeTerminationModal() {
    document.getElementById('terminationModal').classList.add('hidden');
}
</script>
