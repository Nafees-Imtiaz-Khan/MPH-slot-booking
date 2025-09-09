<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Book Slot for {{ $sport->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('sports.book.submit', $sport->id) }}">
                @csrf

                <div class="mb-4">
                    <label for="date">Select Date:</label><br>
                    <input type="date" name="date" id="date" required>
                </div>

                <div class="mb-4">
                    <label for="slot">Select Time Slot:</label><br>
                    <select name="slot" id="slot" required>
                        @foreach ($slots as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                @if ($sport->boards > 1)
                    <div class="mb-4">
                        <label for="board_number">Board Number (1 to {{ $sport->boards }}):</label><br>
                        <select name="board_number" id="board_number" required>
                            @for ($i = 1; $i <= $sport->boards; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                @endif

                <button type="submit">Confirm Booking</button>
            </form>
        </div>
    </div>
</x-app-layout>
