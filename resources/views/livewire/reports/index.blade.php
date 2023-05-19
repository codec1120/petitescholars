<div>
    <x-notification />
    <x-header :title="'Reports'"/>
    <div class="w-full h-full fixed top-0 left-0 bg-white opacity-75 z-50 @if($loading) block @else hidden @endif">
        <span class="text-green-500 opacity-75 top-1/2 my-0 mx-auto block relative w-0 h-0" style="
            top: 50%;
        ">
            <i class="fas fa-circle-notch fa-spin fa-5x"></i>
            Exporting...
        </span>
        
    </div>
    <x-content>
    <!-- Staff Exporting -->
    <x-card>
        <x-slot name="header">
            <x-card-title>Staff Exports</x-card-title>
        </x-slot>
        <x-slot name="body">
            <div>
                <p class="mt-5 text-xl font-light">Export all staff information in a CSV file format.</p>
                <div>
                    <x-jet-button class="mt-10 bg-[#ED5314]" wire:click="exportStaff" wire:loading.attr="loading">
                        Download
                    </x-jet-button>
                </div>
            </div>
        </x-slot>
    </x-card>
    <!-- Parent Exporting -->
    <x-card>
        <x-slot name="header">
            <x-card-title>Parent Exports</x-card-title>
        </x-slot>
        <x-slot name="body">
            <div>
                <p class="mt-5 text-xl font-light">Export all parent information in a CSV file format.</p>
                <div>
                    <x-jet-button class="mt-10 bg-[#ED5314]" wire:click="exportParents">
                        Download
                    </x-jet-button>
                </div>
            </div>
        </x-slot>
    </x-card>
    <!-- Children Exporting -->
    <x-card>
        <x-slot name="header">
            <x-card-title>Children Exports</x-card-title>
        </x-slot>
        <x-slot name="body">
            <div>
                <p class="mt-5 text-xl font-light">Export all children information in a CSV file format.</p>
                <div>
                    <x-jet-button class="mt-10 bg-[#ED5314]" wire:click="exportChildren">
                        Download
                    </x-jet-button>
                </div>
            </div>
        </x-slot>
    </x-card>
    </x-content>
</div>
