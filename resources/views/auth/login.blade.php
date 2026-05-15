<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="wellmeadows-glass-container">

            <h1>Welcome Back</h1>
            <p>Please login to continue</p>

            <div class="input-group">
                <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Email Address" class="your-custom-input-style">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="input-group mt-4">
                <input type="password" name="password" required placeholder="Password" class="your-custom-input-style">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <button type="submit" class="your-custom-button-style">
                    Login
                </button>
            </div>

            @if (Route::has('password.request'))
                <div class="mt-4 text-center">
                    <a class="underline text-sm text-gray-400 hover:text-white" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
            @endif

        </div>
    </form>
</x-guest-layout>
