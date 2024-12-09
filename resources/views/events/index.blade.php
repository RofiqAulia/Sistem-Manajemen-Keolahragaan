{{-- resources/views/admin/events/index.blade.php --}}
@extends('layouts.template')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Manage Events</h1>
        <a href="{{ route('admin.events.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add New Event</a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Event Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Category</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Date</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($events as $event)
                <tr>
                    <td class="px-6 py-4">{{ $event->nama_event }}</td>
                    <td class="px-6 py-4">{{ $event->cabor->nama }}</td>
                    <td class="px-6 py-4">{{ $event->tanggal_mulai->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-sm rounded-full 
                            @if($event->status === 'upcoming') bg-blue-100 text-blue-800
                            @elseif($event->status === 'ongoing') bg-green-100 text-green-800
                            @elseif($event->status === 'completed') bg-gray-100 text-gray-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($event->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.events.edit', $event) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $events->links() }}
    </div>
</div>
@endsection
