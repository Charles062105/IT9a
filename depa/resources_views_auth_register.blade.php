<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MedClinic — Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center py-10">
<div class="w-full max-w-md bg-white rounded-2xl shadow-sm border border-gray-200 p-8">

    {{-- Logo --}}
    <div class="text-center mb-6">
        <div class="w-12 h-12 bg-teal-600 rounded-xl flex items-center justify-center mx-auto mb-3">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
        </div>
        <h1 class="text-xl font-semibold text-gray-800">Create an Account</h1>
        <p class="text-sm text-gray-400 mt-1">MedClinic Staff Registration</p>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg px-4 py-3 mb-5">
            <ul class="text-sm text-red-700 space-y-1 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Section: Personal Info --}}
        <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-3 pb-1 border-b border-gray-100">
            Personal information
        </p>

        {{-- Name (two columns) --}}
        <div class="grid grid-cols-2 gap-3 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">
                    First name
                </label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-teal-500
                           @error('first_name') border-red-400 @enderror">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">
                    Last name
                </label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-teal-500
                           @error('last_name') border-red-400 @enderror">
            </div>
        </div>

        {{-- Full name hidden (Breeze uses 'name' by default) --}}
        {{-- Or update RegisteredUserController to handle first_name/last_name separately --}}

        {{-- Email --}}
        <div class="mb-4">
            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">
                Email address
            </label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm
                       focus:outline-none focus:ring-2 focus:ring-teal-500
                       @error('email') border-red-400 @enderror">
        </div>

        {{-- Section: Account Setup --}}
        <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-3 pb-1 border-b border-gray-100 mt-5">
            Account setup
        </p>

        {{-- Role --}}
        <div class="mb-4">
            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">
                Role
            </label>
            <select name="role" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm
                       focus:outline-none focus:ring-2 focus:ring-teal-500
                       @error('role') border-red-400 @enderror">
                <option value="">Select a role...</option>
                <option value="admin"  {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff"  {{ old('role') === 'staff' ? 'selected' : '' }}>Staff</option>
            </select>
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">
                Password
            </label>
            <div class="relative">
                <input type="password" name="password" id="pw1" required
                    oninput="checkStrength(this.value)"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm pr-10
                           focus:outline-none focus:ring-2 focus:ring-teal-500
                           @error('password') border-red-400 @enderror">
                <button type="button" onclick="togglePw('pw1')"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5
                                 c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7
                                 -4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
            {{-- Strength Bar --}}
            <div class="mt-1.5 h-1 rounded-full bg-gray-100 overflow-hidden">
                <div id="strength-bar" class="h-full rounded-full transition-all duration-300 w-0"></div>
            </div>
            <p id="strength-text" class="text-xs text-gray-400 mt-1">Enter a password</p>
        </div>

        {{-- Confirm Password --}}
        <div class="mb-5">
            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">
                Confirm password
            </label>
            <div class="relative">
                <input type="password" name="password_confirmation" id="pw2" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm pr-10
                           focus:outline-none focus:ring-2 focus:ring-teal-500">
                <button type="button" onclick="togglePw('pw2')"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5
                                 c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7
                                 -4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full bg-teal-600 hover:bg-teal-700 active:bg-teal-800
                   text-white font-medium py-2.5 rounded-lg text-sm transition-colors duration-150">
            Create account
        </button>
    </form>

    <p class="text-center text-sm text-gray-400 mt-5">
        Already have an account?
        <a href="{{ route('login') }}" class="text-teal-600 hover:underline font-medium">Sign in</a>
    </p>
</div>

<script>
function togglePw(id) {
    const inp = document.getElementById(id);
    inp.type = inp.type === 'password' ? 'text' : 'password';
}
function checkStrength(val) {
    const bar  = document.getElementById('strength-bar');
    const text = document.getElementById('strength-text');
    const score = (val.length >= 8 ? 1 : 0)
                + (/[A-Z]/.test(val) ? 1 : 0)
                + (/[0-9]/.test(val) ? 1 : 0)
                + (/[^A-Za-z0-9]/.test(val) ? 1 : 0);
    if (!val)        { bar.style.width='0'; bar.style.background=''; text.textContent='Enter a password'; }
    else if (score<=1){ bar.style.width='30%'; bar.style.background='#E24B4A'; text.textContent='Weak — add numbers or symbols'; }
    else if (score<=3){ bar.style.width='60%'; bar.style.background='#BA7517'; text.textContent='Fair — try a special character'; }
    else             { bar.style.width='100%'; bar.style.background='#0F6E56'; text.textContent='Strong password'; }
}
</script>
</body>
</html>