<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Student Dashboard
        </h2>
    </x-slot>

    <!-- Success Message -->
    @if (session('success'))
        <div style="background-color: #d1fae5; color: #065f46; padding: 10px 15px; border-radius: 5px; margin: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4">
            <!-- Available Sports Section -->
            <div style="background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #ccc; margin-bottom: 30px;">
                <h3 style="font-size: 1.2rem; font-weight: bold; margin-bottom: 10px;">Available Sports</h3>

                <ul style="list-style-type: disc; padding-left: 20px;">
                    @forelse ($sports as $sport)
                        <li style="margin-bottom: 10px;">
                            <strong>{{ $sport->name }}</strong>
                            @if($sport->boards > 1)
                                ({{ $sport->boards }} boards)
                            @endif
                            <br>
                            <a href="{{ route('sports.book', $sport->id) }}" style="color: #2563eb; text-decoration: underline;">Book Slot</a>
                        </li>
                    @empty
                        <li>No sports available yet.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Booked Slots Section -->
            <div style="background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #ccc;">
                <h3 style="font-size: 1.2rem; font-weight: bold; margin-bottom: 10px;">Your Booked Slots</h3>

                <ul style="list-style-type: none; padding: 0;">
                    @forelse (\App\Models\Booking::where('student_id', auth()->id())->with('sport')->orderBy('date')->get() as $booking)
                        <li style="margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                            <strong>{{ $booking->sport->name }}</strong><br>
                            Date: {{ \Carbon\Carbon::parse($booking->date)->format('F j, Y') }}<br>
                            Time: {{ $booking->slot }}
                            @if ($booking->board_number)
                                | Board: {{ $booking->board_number }}
                            @endif

                            <!-- Cancel Booking Button -->
                            <form method="POST" action="{{ route('booking.cancel', $booking->id) }}" style="margin-top: 5px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to cancel this booking?')"
                                    style="color: red; background: none; border: none; padding: 0; cursor: pointer; text-decoration: underline;">
                                    Cancel Booking
                                </button>
                            </form>
                        </li>
                    @empty
                        <li>You haven't booked any slots yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>


