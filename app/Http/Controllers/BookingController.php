<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Show booking form
    public function showForm($sportId)
    {
        $sport = Sport::findOrFail($sportId);
        $slots = [
            '9-11' => '9:00 AM – 11:00 AM',
            '11-1' => '11:00 AM – 1:00 PM',
            '2-4' => '2:00 PM – 4:00 PM',
            '4-6' => '4:00 PM – 6:00 PM',
        ];

        return view('booking.form', compact('sport', 'slots'));
    }

    // Handle form submission
    public function submitBooking(Request $request, $sportId)
    {
        $sport = Sport::findOrFail($sportId);

        $request->validate([
            'date' => 'required|date',
            'slot' => 'required|string',
            'board_number' => 'nullable|integer',
        ]);

        $student = Auth::user();

        //  Prevent double booking by same student for same sport/slot/date
        $alreadyBookedByStudent = Booking::where('student_id', $student->id)
            ->where('sport_id', $sportId)
            ->where('date', $request->date)
            ->where('slot', $request->slot)
            ->exists();

        if ($alreadyBookedByStudent) {
            return back()->withErrors(['slot' => 'You already booked this slot for this sport.']);
        }

        //  Prevent ANYONE from booking the same slot (and board if applicable)
        $conflictQuery = Booking::where('sport_id', $sportId)
            ->where('date', $request->date)
            ->where('slot', $request->slot);

        if ($sport->boards > 1) {
            $conflictQuery->where('board_number', $request->board_number);
        }

        $conflictExists = $conflictQuery->exists();

        if ($conflictExists) {
            return back()->withErrors(['slot' => 'This slot is already booked. Please choose another.']);
        }

        //  Create the booking
        Booking::create([
            'student_id' => $student->id,
            'sport_id' => $sportId,
            'date' => $request->date,
            'slot' => $request->slot,
            'board_number' => $request->board_number,
        ]);

        return redirect()->route('dashboard')->with('success', 'Slot booked successfully!');
    }
    public function cancel($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // ✅ Only allow the student who booked it to cancel
        if ($booking->student_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->delete();

        return redirect()->route('dashboard')->with('success', 'Booking cancelled successfully.');
    }

}

