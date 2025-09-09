<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: white;
            padding: 30px 40px;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .error {
            color: red;
            font-size: 0.875em;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #003366;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: bold;
        }

        a.back {
            display: inline-block;
            margin-top: 15px;
            text-decoration: underline;
            color: #003366;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Admin Login</h2>

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <label for="admin_id">Admin ID</label>
            <input id="admin_id" type="text" name="admin_id" required autofocus>
            @error('admin_id')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Log In</button>
        </form>

        <a href="{{ url('/') }}" class="back">← Back to Home</a>
    </div>

</body>
</html>
