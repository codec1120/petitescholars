<div>
    <x-header :title="$user->full_name">
      <x-flex class="justify-end space-x-4">
         <x-link :href="route('users.index')">
            <x-heroicon-o-arrow-narrow-left class="w-4 h-4 mr-2" />
            Go Back
         </x-link>
         @if ($user->isStaff())
            <x-jet-button wire:click="goToProfile">
               <x-heroicon-o-user class="w-4 h-4 mr-2" />
               Profile
            </x-jet-button>
         @endif
      </x-flex>
    </x-header>
    <x-content>
         @livewire('users.profile.update-profile-information-form', [
            'user' => $user
         ])
         @livewire('users.profile.update-password-form', [
            'user' => $user
         ])
         {{-- @livewire('users.profile.delete-user-form', [
            'user' => $user
         ]) --}}
    </x-content>
</div>
