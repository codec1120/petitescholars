<div class="col-span-8 sm:col-span-6">
    <x-card>
        <x-slot name="header">
            <x-card-title> Emergency Contact </x-card-title>
        </x-slot>
        <x-slot name="table">  
            @foreach ( $OutdatedEmergencyContactList['list_of_emergency_contact_registered'] as $key => $emergencyData)
                    <x-flex class="justify-between border-b border-gray-200 w-full px-4 py-3">
                        <div class="grid grid-cols-1 gap-2">
                            <p class="block font-medium text-sm text-gray-500">
                                <span class="font-semibold text-gray-800">Emergency Contact Name:</span>
                                {{$emergencyData['first_name'].' '.$emergencyData['last_name']}}
                            </p>
                        </div>
                        <div class="grid grid-cols-1 gap-1">
                            <div>
                                <x-jet-secondary-button wire:click="editEmergencyContact( {{$key}} )">
                                    <x-heroicon-o-pencil class="w-4 h-4 mr-2 "/>
                                    Edit
                                </x-jet-secondary-button>
                                <x-jet-danger-button wire:click="deleteEmergencyContact( {{$key}} )">
                                    <x-heroicon-o-user-remove class="w-4 h-4 mr-2 "/>
                                    Delete
                                </x-jet-danger-button>
                            </div> 
                        </div>
                    </x-flex>
                @endforeach
        </x-slot>
    </x-card>
</div>
