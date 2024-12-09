{{-- resources/views/admin/events/create.blade.php --}}
@extends('layouts.template')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Create New Event</h1>

        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Sports Category</label>
                <select name="kode_cabor" class="w-full rounded border-gray-300">
                    @foreach($cabors as $cabor)
                    <option value="{{ $cabor->kode_cabor }}">{{ $cabor->nama }}</option>
                    @endforeach
                </select>
                @error('kode_cabor')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Event Name</label>
                <input type="text" name="nama_event" class="w-full rounded border-gray-300" value="{{ old('nama_event') }}">
                @error('nama_event')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Description</label>
                <textarea name="deskripsi" rows="4" class="w-full rounded border-gray-300">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Start Date</label>
                    <input type="datetime-local" name="tanggal_mulai" class="w-full rounded border-gray-300" value="{{ old('tanggal_mulai') }}">
                    @error('tanggal_mulai')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">End Date</label>
                    <input type="datetime-local" name="tanggal_selesai" class="w-full rounded border-gray-300" value="{{ old('tanggal_selesai') }}">
                    @error('tanggal_selesai')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Location</label>
                <input type="text" name="lokasi" class="w-full rounded border-gray-300" value="{{ old('lokasi') }}">
                @error('lokasi')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Capacity</label>
                    <input type="number" name="kapasitas" class="w-full rounded border-gray-300" value="{{ old('kapasitas') }}">
                    @error('kapasitas')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Ticket Price</label>
                    <input type="number" name="harga_tiket" class="w-full rounded border-gray-300" value="{{ old('harga_tiket') }}">
                    @error('harga_tiket')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Thumbnail</label>
                <input type="file" name="thumbnail" class="w-full">
                @error('thumbnail')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Create Event
                </button>
            </div>
        </form>
    </div>
</div>
@endsection