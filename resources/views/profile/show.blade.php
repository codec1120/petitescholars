<x-app-layout>
    <x-header title="My Account" />
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('users.profile.update-profile-information-form', [
                'user' => auth()->user()
            ])

            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('users.profile.update-password-form', [
                    'user' => auth()->user()
                ])
            </div>

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('users.profile.two-factor-authentication-form', [
                        'user' => auth()->user()
                    ])
                </div>
            @endif

            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('users.profile.logout-other-browser-sessions-form', [
                    'user' => auth()->user()
                ])
            </div>

            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('users.profile.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
