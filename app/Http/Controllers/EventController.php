<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\TicketCategoryModel;
use App\Models\TicketBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EventModel;

class EventController extends Controller 
{
    public function update(EventModel $request, Event $event)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            if ($event->thumbnail) {
                Storage::disk('public')->delete($event->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('events', 'public');
        }

        $event->update($data);
        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully');
    }

    public function destroy(Event $event)
    {
        if ($event->thumbnail) {
            Storage::disk('public')->delete($event->thumbnail);
        }
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully');
    }
}

class BookingController extends Controller 
{
    public function create($id)
    {
        $category = TicketCategoryModel::findOrFail($id);
        return view('booking.create', compact('category'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_category' => 'required|exists:ticket_categories,id_category',
            'quantity' => 'required|integer|min:1'
        ]);

        $category = TicketCategoryModel::findOrFail($validated['id_category']);

        if ($category->sisa_tiket < $validated['quantity']) {
            return back()->with('error', 'Not enough tickets available');
        }

        $booking = TicketBooking::create([
            'id_user' => auth()->id(),
            'id_category' => $category->id_category,
            'booking_code' => 'BK-' . time() . '-' . rand(1000,9999),
            'quantity' => $validated['quantity'],
            'total_amount' => $category->harga * $validated['quantity'],
            'payment_status' => 'pending'
        ]);

        return redirect()->route('booking.payment', $booking->id);
    }

    public function payment($id)
    {
        $booking = TicketBooking::with('category.event')->findOrFail($id);
        if ($booking->id_user !== auth()->id()) {
            abort(403);
        }
        return view('booking.payment', compact('booking'));
    }

    public function processPayment(Request $request, $id)
    {
        $booking = TicketBooking::findOrFail($id);
        
        if ($booking->id_user !== auth()->id() || $booking->payment_status !== 'pending') {
            abort(403);
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:bank_transfer,ewallet',
            'payment_proof' => 'required|image|max:2048'
        ]);

        $proofPath = $request->file('payment_proof')->store('payments', 'public');

        // \DB::transaction(function() use ($booking, $validated, $proofPath) {
        //     $booking->update([
        //         'payment_status' => 'paid',
        //         'payment_method' => $validated['payment_method'],
        //         'payment_proof' => $proofPath,
        //         'payment_date' => now()
        //     ]);

        //     $booking->category->decrement('sisa_tiket', $booking->quantity);
        // });

        return redirect()->route('booking.history')->with('success', 'Payment submitted successfully');
    }

    public function history()
    {
        $bookings = TicketBooking::where('id_user', auth()->id())
            ->with(['category.event'])
            ->latest()
            ->paginate(10);

        return view('booking.history', compact('bookings'));
    }
}