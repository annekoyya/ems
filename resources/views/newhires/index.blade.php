@extends('layouts.app')

@section('page-title', 'New Hires')
@section('page-subtitle', 'Pending employee profile creation')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">New Hires</h1>
            <p class="text-gray-600">Employees waiting for profile creation</p>
        </div>

        <form method="GET" action="{{ route('newhires.index') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <!-- Department -->
            <div>
                <label class="sr-only" for="department">Department</label>
                <select id="department" name="department" class="block w-full sm:w-48 border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">All Departments</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Date from -->
            <div>
                <label class="sr-only" for="date_from">From</label>
                <input id="date_from" name="date_from" type="date" value="{{ request('date_from') }}" class="block border border-gray-300 rounded-lg px-3 py-2 text-sm" />
            </div>

            <!-- Date to -->
            <div>
                <label class="sr-only" for="date_to">To</label>
                <input id="date_to" name="date_to" type="date" value="{{ request('date_to') }}" class="block border border-gray-300 rounded-lg px-3 py-2 text-sm" />
            </div>

            <div class="flex items-center space-x-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm">Apply</button>
                <a href="{{ route('newhires.index') }}" class="bg-gray-200 text-gray-800 px-3 py-2 rounded-lg hover:bg-gray-300 text-sm">Clear</a>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg border border-green-200">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Active filters info --}}
    @if(request()->filled('department') || request()->filled('date_from') || request()->filled('date_to'))
        <div class="mb-4 p-3 bg-blue-50 text-blue-800 rounded-lg border border-blue-100 text-sm">
            <strong>Filters active:</strong>
            @if(request('department')) Department: <span class="font-medium">{{ request('department') }}</span> @endif
            @if(request('date_from')) • From: <span class="font-medium">{{ request('date_from') }}</span> @endif
            @if(request('date_to')) • To: <span class="font-medium">{{ request('date_to') }}</span> @endif
        </div>
    @endif

@if($newHires->count() > 0)
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Submitted</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($newHires as $hire)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode($hire->first_name . ' ' . $hire->last_name) }}&background=3B82F6&color=fff" 
                                         alt="{{ $hire->first_name }} {{ $hire->last_name }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $hire->first_name }} {{ $hire->last_name }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $hire->position ?? '—' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $hire->department ?? '—' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($hire->status === 'approved')
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                            @elseif($hire->status === 'rejected')
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>
                            @else
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ optional($hire->date_submitted)->format('M d, Y') ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('employees.create', $hire->id) }}" 
                               class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200 inline-flex items-center space-x-2">
                                <i class="fas fa-user-plus"></i>
                                <span>Create Profile</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


        <div class="mt-4 text-sm text-gray-600">
            Showing <strong>{{ $newHires->count() }}</strong> new hire(s)
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">No New Hires</h3>
            <p class="text-gray-600 mb-6">There are no pending new hires matching these filters.</p>
            <a href="{{ route('newhires.index') }}" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 transition duration-200 inline-flex items-center space-x-2">
                <i class="fas fa-sync"></i>
                <span>Reset Filters</span>
            </a>
        </div>
    @endif
</div>
@endsection
