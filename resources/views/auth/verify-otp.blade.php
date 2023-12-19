<x-guest-layout>
    <form method="POST" action="{{ route('otp.check') }}">
        @csrf

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Please enter the OTP sent to your email address to complete the verification process.') }}
        </div>

        <!-- Display Errors -->
        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600 dark:text-red-400">
                <ul>
                    <!-- Only display the first error for OTP to avoid duplication -->
                    <li>{{ $errors->get('otp')[0] ?? '' }}</li>
                </ul>
            </div>
        @endif

        <!-- OTP Input -->
        <div class="mt-4">
            <x-input-label for="otp" :value="__('OTP')" />
            <x-text-input id="otp" class="block mt-1 w-full" type="text" name="otp" required autofocus />
            <!-- Do not display the input error if we already have errors above -->
            @if (!$errors->get('otp'))
                <x-input-error :messages="$errors->get('otp')" class="mt-2" />
            @endif
        </div>

        <!-- Hidden Email Field -->
        <input type="hidden" name="email" value="{{ session('email') }}">

        <!-- Verify OTP Button -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Verify OTP') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Resend OTP Form -->
    <form method="POST" action="{{ route('otp.resend') }}">
        @csrf

        <div class="mt-4">
            <x-primary-button>
                {{ __('Resend OTP') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Logout Form -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mt-4">
            {{ __('Log Out') }}
        </button>
    </form>
</x-guest-layout>
