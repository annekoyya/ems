<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Employee {{ $employee->first_name }} {{ $employee->last_name }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .container { padding: 20px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 8px; border: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
<div class="container">
    <h2>Employee Details</h2>
    <table>
        <tr><th>Full Name</th><td>{{ $employee->first_name }} {{ $employee->middle_name ?? '' }} {{ $employee->last_name }} {{ $employee->name_extension ?? '' }}</td></tr>
        <tr><th>Date of Birth</th><td>{{ $employee->date_of_birth ? date('d/m/Y', strtotime($employee->date_of_birth)) : 'N/A' }}</td></tr>
        <tr><th>Email</th><td>{{ $employee->email }}</td></tr>
        <tr><th>Phone Number</th><td>{{ $employee->phone_number ?? '-' }}</td></tr>
        <tr><th>Address</th><td>{{ $employee->home_address ?? '-' }}</td></tr>
        <tr><th>Emergency Contact</th><td>{{ $employee->emergency_contact_name ?? '-' }} ({{ $employee->emergency_contact_number ?? '-' }})</td></tr>
        <tr><th>Relationship</th><td>{{ $employee->relationship ?? '-' }}</td></tr>
        <tr><th>TIN</th><td>{{ $employee->tin ?? '-' }}</td></tr>
        <tr><th>SSS Number</th><td>{{ $employee->sss_number ?? '-' }}</td></tr>
        <tr><th>Pag-IBIG Number</th><td>{{ $employee->pagibig_number ?? '-' }}</td></tr>
        <tr><th>Bank Name</th><td>{{ $employee->bank_name ?? '-' }}</td></tr>
        <tr><th>Account Name</th><td>{{ $employee->account_name ?? '-' }}</td></tr>
        <tr><th>Account Number</th><td>{{ $employee->account_number ?? '-' }}</td></tr>
        <tr><th>Department</th><td>{{ $employee->department }}</td></tr>
        <tr><th>Job Category</th><td>{{ $employee->job_category ?? '-' }}</td></tr>
        <tr><th>Employment Type</th><td>{{ $employee->employment_type ?? '-' }}</td></tr>
        <tr><th>Start Date</th><td>{{ $employee->start_date ? date('d/m/Y', strtotime($employee->start_date)) : 'N/A' }}</td></tr>
        <tr><th>Reporting Manager</th><td>{{ $employee->reporting_manager }}</td></tr>
    </table>
</div>
</body>
</html>
