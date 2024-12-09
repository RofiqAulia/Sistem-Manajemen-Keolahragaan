{{-- resources/views/booking/create.blade.php --}}
@extends('layouts.template')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Book Tickets</h1>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">{{ $category->event->nama_event }}</h2>
            <div class="mb-4">
                <p class="text-gray-600">{{ $category->nama_kategori }}</p>
                <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($category->harga) }}</p>
            </div>
            
            <form action="{{ route('ticket.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="id_category" value="{{ $category->id_category }}">

                <div>
                    <label class="block text-sm font-medium mb-1">Number of Tickets</label>
                    <input type="number" name="quantity" min="1" max="{{ min($category->sisa_tiket, $category->max_tickets_per_user) }}" 
                           class="w-full rounded border-gray-300" value="1">
                    @error('quantity')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="border-t pt-4">
                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Continue to Payment
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-gray-50 rounded-lg p-4">
            <h3 class="font-semibold mb-2">Important Notes:</h3>
            <ul class="text-sm text-gray-600 space-y-1">
                <li>• Tickets are non-refundable</li>
                <li>• Maximum {{ $category->max_tickets_per_user }} tickets per transaction</li>
                <li>• Please complete payment within 1 hour</li>
            </ul>
        </div>
    </div>
</div>
@endsection