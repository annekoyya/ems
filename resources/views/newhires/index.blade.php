@extends('layouts.app')

@section('page-title', 'New Hires')
@section('page-subtitle', 'Pending employee profile creation')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">New Hires</h1>
            <p class="text-gray-600">Employees waiting for profile creation</p>
        </div>
        {{-- <a href="{{ route('newhires.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Add New Hire</span>
        </a> --}}
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg border border-green-200">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
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
                                             src="https://ui-avatars.com/api/?name={{ urlencode($hire->fullname) }}&background=3B82F6&color=fff" 
                                             alt="{{ $hire->fullname }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $hire->fullname }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $hire->position }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $hire->department }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $hire->date_submitted->format('M d, Y') }}
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

        <!-- Results Count -->
        <div class="mt-4 text-sm text-gray-600">
            Showing <strong>{{ $newHires->count() }}</strong> new hire(s)
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">No New Hires</h3>
            <p class="text-gray-600 mb-6">There are no pending new hires at the moment.</p>
            <a href="{{route('newhires.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200 inline-flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Add New Hire</span>
            </a>
        </div>
    @endif
</div>
@endsection