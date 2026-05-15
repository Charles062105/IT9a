<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MedClinic — Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<div class="w-full max-w-md bg-white rounded-2xl shadow-sm border border-gray-200 p-8">

    {{-- Logo --}}
    <div class="text-center mb-6">
        <div class="w-12 h-12 bg-teal-600 rounded-xl flex items-center justify-center mx-auto mb-3">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </div>
        <h1 class="text-xl font-semibold text-gray-800">MedClinic System</h1>
        <p class="text-sm text-gray-400 mt-1">Appointment & Resource Management</p>
    </div>

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg px-4 py-3 mb-5 flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
            </svg>
            {{ $errors->first() }}
        </div>
    @endif

    {{-- Session Status (e.g. after password reset) --}}
    @if (session('status'))
        <div class="bg-teal-50 border border-teal-200 text-teal-700 text-sm rounded-lg px-4 py-3 mb-5">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="mb-4">
            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">
                Email address
            </label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm
                       focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent
                       @error('email') border-red-400 @enderror">
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">
                Password
            </label>
            <div class="relative">
                <input type="password" name="password" id="pw-input" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm pr-10
                           focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                <button type="button" onclick="togglePassword()"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                                 -1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Remember Me + Forgot Password --}}
        <div class="flex items-center justify-between mb-5">
            <label class="flex items-center gap-2 text-sm text-gray-500 cursor-pointer">
                <input type="checkbox" name="remember"
                    class="rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                Remember me
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm text-teal-600 hover:underline">Forgot password?</a>
            @endif
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full bg-teal-600 hover:bg-teal-700 active:bg-teal-800
                   text-white font-medium py-2.5 rounded-lg text-sm transition-colors duration-150">
            Sign in to MedClinic
        </button>
    </form>

    @if (Route::has('register'))
        <p class="text-center text-sm text-gray-400 mt-5">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-teal-600 hover:underline font-medium">
                Register here
            </a>
        </p>
    @endif
</div>

<script>
function togglePassword() {
    const input = document.getElementById('pw-input');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
</body>
</html>