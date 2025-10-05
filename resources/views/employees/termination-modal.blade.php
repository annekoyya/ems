<!-- Termination Modal -->
<div id="terminationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg w-[460px] p-6 relative">
        <button type="button" id="terminationCloseBtn" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-xl">&times;</button>
        <h2 class="text-xl font-bold mb-4">Terminate Employee</h2>

        <!-- Employee Info -->
        <div class="mb-4 p-3 bg-gray-100 rounded">
            <p><strong>Employee ID:</strong> <span id="terminationEmployeeId"></span></p>
            <p><strong>Name:</strong> <span id="terminationEmployeeName"></span></p>
            <p><strong>Submission Date:</strong> <span id="terminationSubmissionDate"></span></p>
        </div>

        <form id="terminationForm" method="POST">
            @csrf
            <div class="mb-3">
                <label class="block font-medium">Last Working Day <span class="text-red-500">*</span></label>
                <input type="date" name="last_working_day" id="lastWorkingDay" class="border rounded w-full p-2" required>
                <p class="text-red-500 text-sm hidden" id="dateError">⚠ Last working day cannot be before today.</p>
            </div>

            <div class="mb-3">
                <label class="block font-medium">Reason for Leaving <span class="text-red-500">*</span></label>
                <textarea name="reason" id="reason" class="border rounded w-full p-2" required></textarea>
                <p class="text-red-500 text-sm hidden" id="reasonError">⚠ Please provide a reason.</p>
            </div>

            <label class="block font-medium">Required Documentation <span class="text-red-500">*</span></label>
            <div class="mb-3">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="documentation" id="documentation" class="form-checkbox">
                    <span class="ml-2">Documentation & Compliance</span>
                </label>
            </div>

            <div class="mb-3">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="exit_interview" id="exitInterview" class="form-checkbox">
                    <span class="ml-2">Exit Interview</span>
                </label>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Required Paperwork <span class="text-red-500">*</span></label>
                <div>
                    <label class="inline-flex items-center mr-4">
                        <input type="checkbox" name="clearance_form" id="clearanceForm" class="form-checkbox">
                        <span class="ml-2">Clearance Form</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="final_pay_ack" id="finalPayAck" class="form-checkbox">
                        <span class="ml-2">Final Pay Acknowledgment</span>
                    </label>
                </div>
                <p class="text-red-500 text-sm hidden" id="checkboxError">⚠ All paperwork and documentation must be completed.</p>
            </div>

            <button type="button" id="terminationValidateBtn" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 w-full">Terminate Employee</button>
        </form>
    </div>
</div>

<!-- Confirm modal -->
<div id="confirmTerminationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96 shadow-lg">
        <h2 class="text-lg font-bold mb-4">Confirm Termination</h2>
        <p class="mb-6">Are you sure you want to terminate <strong id="confirmEmployeeName"></strong> (ID: <span id="confirmEmployeeId"></span>)?</p>
        <div class="flex justify-end space-x-3">
            <button type="button" id="confirmCancelBtn" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
            <button type="button" id="confirmSubmitBtn" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Confirm</button>
        </div>
    </div>
</div>

<!-- Toast placeholder -->
@if(session('success'))
<div id="terminationToast" class="fixed top-5 right-5 bg-green-600 text-white px-4 py-3 rounded shadow-lg z-50 animate-fade-in">
    {{ session('success') }}
</div>
@endif