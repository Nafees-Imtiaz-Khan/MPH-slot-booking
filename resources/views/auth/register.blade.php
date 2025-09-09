<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div class="mt-4">
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required class="block mt-1 w-full" />
        @error('name')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <!-- Student ID -->
    <div class="mt-4">
        <label for="student_id">Student ID</label>
        <input id="student_id" type="text" name="student_id" value="{{ old('student_id') }}" required class="block mt-1 w-full" />
        @error('student_id')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="mt-4">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required class="block mt-1 w-full" />
        @error('email')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password -->
    <div class="mt-4">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required class="block mt-1 w-full" />
        @error('password')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required class="block mt-1 w-full" />
        @error('password_confirmation')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
            Already registered?
        </a>

        <button type="submit" class="ml-4 px-4 py-2 bg-blue-600 text-white rounded">
            Register
        </button>
    </div>
</form>

