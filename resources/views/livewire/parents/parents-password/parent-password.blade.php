<div>
    <x-header :title="'Parents Password'"/>
    <x-notification />
    <x-livewire-alert::scripts />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<div>
<x-content>
    <x-flex class="space-x-2">
        <div class="w-64">
            <x-link :href="route('parents')">
                <x-heroicon-o-arrow-narrow-left class="w-4 h-4 mr-2" />
                Go Back
            </x-link>
        </div>
    </x-flex>
    <form wire:submit.prevent="submit">
        <x-card>
            <x-slot name="header">
                <x-card-title> Parents Password </x-card-title>
            </x-slot>
            <x-slot name="table">
                <div class="bg-white grid grid-cols-2">
                    <div class="bg-white grid grid-cols-1">
                        <x-list-data-input label="Password: " >
                            <x-jet-input
                                id="password"
                                type="password"
                                class="block w-full"
                                wire:model.defer="parentFields.password"
                                autocomplete="false"
                            />
                        @error('parentFields.password') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </x-list-data-input>
                </div>
            </x-slot>
        </x-card>
        <x-card-action>
            <div>
                <x-jet-button wire:click="$set('edited', 'true')">
                    Create Password
                </x-jet-button>    
            </div>
        </x-card-action>
    </form>
</x-content>