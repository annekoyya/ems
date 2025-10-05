@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded">
    <h1 class="text-2xl font-bold mb-6">Terminate Employee: {{ $employee->first_name }} {{ $employee->last_name }}</h1>

    <form action="{{ route('terminations.store', $employee->id) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-medium">Last Working Day</label>
            <input type="date" name="last_working_day" class="border rounded w-full p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Reason for Leaving</label>
            <textarea name="reason" class="border rounded w-full p-2" required></textarea>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="documentation" class="form-checkbox">
                <span class="ml-2">Documentation & Compliance</span>
            </label>
        </div>

        <div class="mb-4">
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

        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Terminate Employee</button>
    </form>
</div>
@endsection
