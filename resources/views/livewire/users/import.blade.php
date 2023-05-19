<div>
    <x-jet-secondary-button
        class="ml-2"
        wire:click="$set('showImportUserModal', true)"
        wire:loading.attr="disabled"
    >
        <x-heroicon-o-upload class="w-4 h-4" />
        <span class="ml-2 hidden sm:block"> Import </span>
    </x-jet-secondary-button>
    <x-jet-modal :id="'import-users'" wire:model="showImportUserModal">
        <div class="px-6 py-4">
            <div class="text-lg font-semibold">
                User Importer
                <div class="mt-4">
                    <x-jet-label for="sheet" value="Browse CSV File" class="mb-1" />
                    <x-jet-input
                        id="sheet"
                        type="file"
                        class="block w-full"
                        wire:model.lazy="sheet"
                    />
                    <x-jet-input-error for="sheet" class="mt-2" />
                </div>
            </div>
        </div>
        <x-card-action>
            <x-jet-secondary-button class="mr-2" wire:click="$set('showImportUserModal', false)">
                Close
            </x-jet-secondary-button>
            <x-jet-button wire:click="import"  wire:loading.attr="disabled" :disabled="!$canImport && $errors->has('sheet')">
                Import
            </x-jet-button>
        </x-card-action>
    </x-jet-modal>
</div>