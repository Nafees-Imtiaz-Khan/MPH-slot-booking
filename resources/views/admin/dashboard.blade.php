<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f5f5f5;
            padding: 30px;
        }
        .container {
            background: white;
            padding: 25px;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            max-width: 1100px;
            margin: auto;
        }
        h2, h3 {
            margin-bottom: 20px;
        }
        input, button {
            padding: 6px 10px;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        th {
            background-color: #003366;
            color: white;
        }
        .btn-delete {
            background-color: #dc2626;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 6px 10px;
            cursor: pointer;
        }
        .btn-add {
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 6px 10px;
            cursor: pointer;
        }
        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .link {
            display: inline-block;
            margin-top: 20px;
            color: #003366;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, Admin</h2>

        <!--  Success Message -->
        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <!--  Add New Sport -->
        <h3>Add a New Sport</h3>
        <form method="POST" action="{{ route('admin.sports.store') }}">
            @csrf
            <label for="name">Sport Name:</label><br>
            <input type="text" name="name" id="name" required><br>

            <label for="boards">Number of Boards:</label><br>
            <input type="number" name="boards" id="boards" value="1" min="1" max="10" required><br>

            <button type="submit" class="btn-add">Add Sport</button>
        </form>

        <!--  List of All Sports -->
        <h3 style="margin-top: 40px;">All Sports</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sport Name</th>
                    <th>Boards</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse (\App\Models\Sport::all() as $sport)
                    <tr>
                        <td>{{ $sport->id }}</td>
                        <td>{{ $sport->name }}</td>
                        <td>{{ $sport->boards }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.sports.destroy', $sport->id) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this sport?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">No sports available.</td></tr>
                @endforelse
            </tbody>
        </table>

        <!--  All Bookings -->
        <h3 style="margin-top: 40px;">All Bookings</h3>
        <table>
            <thead>
                <tr>
                    <th>Sport</th>
                    <th>Student Name</th>
                    <th>Student ID</th>
                    <th>Date</th>
                    <th>Slot</th>
                    <th>Board</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->sport->name }}</td>
                        <td>{{ $booking->student->name }}</td>
                        <td>{{ $booking->student->student_id }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->date)->format('F j, Y') }}</td>
                        <td>{{ $booking->slot }}</td>
                        <td>{{ $booking->board_number ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6">No bookings yet.</td></tr>
                @endforelse
            </tbody>
        </table>

        <!--  Manage Students -->
        <a href="{{ route('admin.students') }}" class="link">Manage Students (Ban/Unban)</a>

        <!--  Logout -->
        <a href="{{ route('admin.logout') }}" class="link">Logout</a>
    </div>
</body>
</html>






