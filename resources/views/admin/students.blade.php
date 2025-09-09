<!DOCTYPE html>
<html>
<head>
    <title>Manage Students</title>
    <style>
        body { font-family: sans-serif; background: #f5f5f5; padding: 30px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 10px; border: 1px solid #ddd; }
        th { background: #003366; color: white; }
        button { padding: 6px 10px; border: none; border-radius: 4px; cursor: pointer; }
        .ban { background: #dc2626; color: white; }
        .unban { background: #16a34a; color: white; }
    </style>
</head>
<body>
    <h2>All Students</h2>

    @if (session('success'))
        <div style="color: green; margin-bottom: 20px;">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Student ID</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->student_id }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->is_banned ? 'Banned' : 'Active' }}</td>
                    <td>
                        @if ($student->is_banned)
                            <form method="POST" action="{{ route('admin.students.unban', $student->id) }}">
                                @csrf
                                <button class="unban">Unban</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.students.ban', $student->id) }}">
                                @csrf
                                <button class="ban">Ban</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <a href="{{ route('admin.dashboard') }}">← Back to Dashboard</a>
</body>
</html>
