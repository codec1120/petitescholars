<div>
    <x-jet-danger-button
        wire:click="$set('confirmingFileDeletion', true)">
        <x-heroicon-o-trash class="w-4 h-4 mr-2 "/>
        Delete
    </x-jet-danger-button>
    <x-jet-dialog-modal wire:model="confirmingFileDeletion">
        <x-slot name="title">
            Delete Review?
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete review? Once the review is deleted, the review will permanently deleted.
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingFileDeletion')" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="confirmDelete" wire:loading.attr="disabled">
                Delete
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
