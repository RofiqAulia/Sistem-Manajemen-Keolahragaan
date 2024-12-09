{{-- resources/views/booking/payment.blade.php --}}
@extends('layouts.template')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Payment Details</h1>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-4">Booking Summary</h2>
                <div class="space-y-2">
                    <p><span class="text-gray-600">Event:</span> {{ $booking->category->event->nama_event }}</p>
                    <p><span class="text-gray-600">Category:</span> {{ $booking->category->nama_kategori }}</p>
                    <p><span class="text-gray-600">Quantity:</span> {{ $booking->quantity }} tickets</p>
                    <p><span class="text-gray-600">Total Amount:</span> 
                       <span class="text-xl font-bold text-blue-600">Rp {{ number_format($booking->total_amount) }}</span></p>
                </div>
            </div>

            <form action="{{ route('booking.process-payment', $booking) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-1">Payment Method</label>
                    <select name="payment_method" class="w-full rounded border-gray-300">
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="ewallet">E-Wallet</option>
                    </select>
                    @error('payment_method')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Payment Proof</label>
                    <input type="file" name="payment_proof" class="w-full">
                    @error('payment_proof')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="border-t pt-4">
                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Submit Payment
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-gray-50 rounded-lg p-4">
            <h3 class="font-semibold mb-2">Bank Account Details:</h3>
            <p class="text-gray-600">Bank BCA<br>1234567890<br>Sports UKM</p>
        </div>
    </div>
</div>
@endsection