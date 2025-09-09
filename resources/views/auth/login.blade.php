<x-guest-layout>
    <!-- Back to Home -->
    <a href="{{ url('/') }}" class="text-blue-500 underline mb-4 inline-block">← Back to Home</a>
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Student ID -->
        <div class="mt-4">
            <label for="student_id" class="block text-sm font-medium text-gray-700">Student ID</label>
            <input id="student_id" type="text" name="student_id" required autofocus class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" />
            @error('student_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" />
            @error('password')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 mr-4" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif

            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Log in
            </button>
        </div>
    </form>
</x-guest-layout>

