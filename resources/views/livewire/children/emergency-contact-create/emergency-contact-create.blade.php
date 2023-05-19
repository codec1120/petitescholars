
<x-card>
    <x-slot name="header">
        <x-card-title> Emergency Contact </x-card-title>
    </x-slot>
    <x-slot name="table">
        <div class="bg-white grid grid-cols-1 p-5">
            <span class="font-bold text-gray-500"> The following adults are listed as an emergency contact. </span>
        </div>
        <div class="bg-white grid grid-cols-1">
            <x-list-data wire:key="primary_name" label="Primary Guardian Name: " :value="$primaryGuardianFields['isPrimaryGuardian'] == 'yes' ? $guardianFirstName.' '.$guardianLastName : $primaryGuardianFields['first_name'].' '.$primaryGuardianFields['last_name']" />
        </div>
        <div class="bg-white grid grid-cols-1">
            <x-list-data wire:key="secondary_name" label="Secondary Guardian Name: " :value="$secondaryGuardianFields['first_name'].' '.$secondaryGuardianFields['last_name']" />
        </div>
        <div class="bg-white grid grid-cols-1 p-5">
            <span class="font-bold text-gray-500"> Would you like to add another Emergency Contact? </span>
        </div>
        <div class="p-5">
        <x-forms.select
                id="allowAdditionOfEmergencyContact"
                label=""
                :options="$emergencyContactFields['option']"
                placeholder="Please select..."
                error="emergencyContactFields.selected_option"
                wire:model="emergencyContactFields.selected_option"
            />
        </div>

        @if ( $emergencyContactFields['selected_option'] )
        <div class="bg-white grid grid-cols-1 p-5">
            <span class="font-bold text-gray-500"> Emergency Contact Information. </span>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="First Name: " >
                    <x-jet-input
                        id="contact_first_name"
                        type="text"
                        class="block w-full"
                        wire:model.defer="emergencyContactFields.first_name"
                        autocomplete="false"
                    />
                @error('emergencyContactFields.first_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Last Name: " >
                    <x-jet-input
                        id="contact_last_name"
                        type="text"
                        class="block w-full"
                        wire:model.defer="emergencyContactFields.last_name"
                        autocomplete="false"
                    />
                @error('emergencyContactFields.last_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Phone Number: " >
                    <x-jet-input
                        id="contact_phone_number"
                        type="text"
                        class="block w-full"
                        wire:model.defer="emergencyContactFields.phone_number"
                        autocomplete="false"
                    />
                @error('emergencyContactFields.phone_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Relationship: " >
                    <x-jet-input
                        id="contact_relationship"
                        type="text"
                        class="block w-full"
                        wire:model.defer="emergencyContactFields.relationship"
                        autocomplete="false"
                    />
                @error('emergencyContactFields.relationship') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        @endif
        
    </x-slot>
</x-card> 
<div>
@if ( $emergencyContactFields['selected_option'] )
    <x-card-action>
        <x-jet-danger-button wire:click="cancelAddtionalEmergency">
            Cancel
        </x-jet-danger-button>
        <x-jet-secondary-button class="ml-2" wire:click="addEmergencyContact" >
                <span >{{$emergencyContactFields['emergencyEditId'] ? 'Update': 'Add'}}</span>
        </x-jet-secondary-button>
    </x-card-action> 
@endif
</div>
</br>
<x-card>
    <x-slot name="header">
        <x-card-title>List of Emergency Contacts</x-card-title>
    </x-slot>
    <x-slot name="table">
        @if ( count( $emergencyContactFields['list_of_emergency_contact_registered'] ) == 0 )
        <x-flex class="justify-between border-b border-gray-200 w-full px-4 py-3">
            <div class="grid grid-cols-1 gap-2">
                <p class="block font-medium text-sm text-gray-500">
                    <span class="font-semibold text-gray-800">No Emergency Contact Registered.</span>
                </p>
            </div>
        </x-flex>
        @endif
        @foreach ( $emergencyContactFields['list_of_emergency_contact_registered'] as $key => $emergencyData)
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
    <x-slot name="actions">
        <button type="button"
            wire:click="$set('createEmergencyContact', false)"
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <x-heroicon-o-arrow-narrow-left class="w-4 h-4" />Back
        </button>
        <button type="button" 
            wire:click="createEmergencyContactInfo"
            class="inline-flex items-center justify-center p-2 rounded-md text-green-400 hover:text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-500 transition duration-150 ease-in-out">
            Save <x-heroicon-o-save class="w-4 h-4" />  
        </button>
    </x-slot>
</x-card> 