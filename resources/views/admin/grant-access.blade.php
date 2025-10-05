@extends('layouts.app')

@section('content')
<div x-data="grantAccess()" class="p-6 bg-blue-50 min-h-screen">
  <h1 class="text-2xl font-bold mb-6">Employee Management / Manage Access Rights</h1>

  <div class="bg-white shadow-md rounded-xl overflow-hidden">
    <table class="min-w-full border-collapse">
      <thead class="bg-blue-100 text-left text-sm font-semibold text-gray-700">
        <tr>
          <th class="p-3">ID</th>
          <th class="p-3">Name</th>
          <th class="p-3">Department</th>
          <th class="p-3">Job Category</th>
          <th class="p-3">Start Date</th>
          <th class="p-3">Employment Type</th>
          <th class="p-3 text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <template x-for="emp in filteredEmployees" :key="emp.id">
          <tr class="border-b hover:bg-gray-50 transition">
            <td class="p-3" x-text="emp.id"></td>
            <td class="p-3" x-text="emp.first_name + ' ' + (emp.last_name || '')"></td>
            <td class="p-3" x-text="emp.department || 'Not specified'"></td>
            <td class="p-3" x-text="emp.job_category || 'Not specified'"></td>
            <td class="p-3" x-text="emp.start_date || 'Not set'"></td>
            <td class="p-3" x-text="emp.employment_type || 'Not set'"></td>
            <td class="p-3 text-center">
              <button @click="openModal(emp)" class="text-blue-600 hover:text-blue-800 font-semibold">
                🔑 Grant
              </button>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>

  {{-- Grant Access Modal --}}
{{-- Grant Access Modal --}}
<div 
    x-cloak
    x-show="showModal" 
    x-transition.opacity 
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40"
>
  <div 
      class="bg-white rounded-xl shadow-xl w-96 p-6 relative"
      @click.away="showModal = false"
  >
    <button 
        class="absolute top-3 right-3 text-gray-400 hover:text-gray-700" 
        @click="showModal = false"
    >
      ✖
    </button>

    <h2 class="text-xl font-semibold mb-4">Grant Access Rights</h2>

    <div class="space-y-3">
      <div>
        <label class="block text-sm font-semibold">Employee Name</label>
        <input type="text" x-model="selectedEmployee.full_name" class="w-full border rounded-lg p-2" readonly>
      </div>

      <div>
        <label class="block text-sm font-semibold">Department</label>
        <input type="text" x-model="selectedEmployee.department" class="w-full border rounded-lg p-2" readonly>
      </div>

      <div>
        <label class="block text-sm font-semibold">Job Position</label>
        <input type="text" x-model="selectedEmployee.job_category" class="w-full border rounded-lg p-2" readonly>
      </div>

      <div>
        <label class="block text-sm font-semibold">Access Rights *</label>
        <select x-model="accessRole" class="w-full border rounded-lg p-2">
          {{-- <option value="">Employee</option> --}}
          <option value="admin">Admin</option>
          <option value="manager">Manager</option>
          <option value="hr">HR</option>
        </select>
      </div>

      <div>
        <label class="block text-sm font-semibold">Admin Email *</label>
        <input type="email" x-model="adminEmail" class="w-full border rounded-lg p-2" placeholder="admin@example.com">
      </div>

      <div>
        <label class="block text-sm font-semibold">Admin Password *</label>
        <input type="password" x-model="adminPassword" class="w-full border rounded-lg p-2" placeholder="Enter admin password">
      </div>
    </div>

    <div class="mt-5 flex justify-end gap-3">
      <button @click="showModal=false" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">Cancel</button>
      <button @click="grantAccess" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold">
        Grant Access
      </button>
    </div>
  </div>
</div>

 

  {{-- Toast --}}
  <template x-if="toast.show">
    <div class="fixed bottom-5 right-5 px-4 py-3 rounded-lg shadow-md"
         :class="toast.type === 'error' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'"
         x-transition>
      <span class="font-semibold" x-text="toast.message"></span>
    </div>
  </template>
</div>

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
async grantAccess() {
  if (!this.accessRole || !this.adminEmail || !this.adminPassword) {
    this.showToast('error', 'All fields are required.');
    return;
  }

  try {
    const formData = new FormData();
    formData.append('employee_id', this.selectedEmployee.id);
    formData.append('role', this.accessRole);
    formData.append('admin_id', this.adminEmail);
    formData.append('admin_password', this.adminPassword);
    formData.append('_token', '{{ csrf_token() }}');

    const response = await fetch('{{ route("admin.grant-access") }}', {
      method: 'POST',
      body: formData,
    });

    const data = await response.json();

    if (!response.ok) {
      throw new Error(data.message || 'Request failed.');
    }

    this.showToast('success', data.message);
    this.showModal = false;
    
  } catch (err) {
    console.error('Error:', err);
    this.showToast('error', err.message);
  }
}</script>
@endpush
@endsection
