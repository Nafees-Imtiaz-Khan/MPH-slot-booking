<!DOCTYPE html>
<html>
<head>
    <title>BRACU MPH Slot Booking</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f3f4f6;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 30px;
        }

        .button-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 250px;
        }

        a.button {
            display: block;
            padding: 12px;
            text-align: center;
            background-color: #003366;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        a.button:hover {
            background-color: #0055a5;
        }
    </style>
</head>
<body>

    <h1>Welcome to BRACU MPH Slot Booking</h1>

    <div class="button-list">
        <a href="{{ route('register') }}" class="button">Register as Student</a>
        <a href="{{ route('admin.register') }}" class="button">Register as Admin</a>
        <a href="{{ route('login') }}" class="button">Login as Student</a>
        <a href="{{ route('admin.login') }}" class="button">Login as Admin</a>
    </div>

</body>
</html>

