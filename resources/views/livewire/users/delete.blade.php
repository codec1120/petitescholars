<div>
    <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
        @svg('heroicon-o-trash', 'w-4 h-4')
    </x-jet-danger-button>
    <x-jet-dialog-modal wire:model="confirmingUserDeletion">
        <x-slot name="title">
            Delete User Account
        </x-slot>

        <x-slot name="content">
        <p>
            Are you sure you want to delete user account? Once the account is deleted, all of its resources and data will be permanently deleted. Please enter the user email to confirm you would like to permanently delete the user account.
        </p>
        <span class="text-gray-500"> {{ $this->user->email }}</span>

            <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.email.focus(), 250)">
                <x-jet-input type="email" class="mt-1 block w-3/4" placeholder="Email"
                            x-ref="email"
                            wire:model.defer="email"
                            wire:keydown.enter="deleteUser" />

                <x-jet-input-error for="email" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                Delete Account
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
