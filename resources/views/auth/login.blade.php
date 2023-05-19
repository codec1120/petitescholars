<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label value="Email" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label value="Password" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>
            <div class="bg-white grid grid-cols-2 mt-4">
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <div class="block w-full bg-white grid grid-cols-1">
                    <x-jet-button class="justify-center w-full text-center">
                        {{ __('Login') }}
                    </x-jet-button>
                </div>
            </div>
            <div class="block mt-7 text-center">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <div class="block mt-4">
                Don't have a Petite Scholars account?
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('create-user') }}">
                    {{ __("Click here.") }}
                </a>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
