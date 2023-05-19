<div>
    <x-notification />
    <x-content>
        <div class="col-span-8 sm:col-span-6">
            <form wire:submit.prevent="submit">
            <!-- Emergency  Contacts -->
            @foreach($newEmergencyContactFields['list_of_emergency_contact_registered'] as $key =>  $item)
            <x-card>
                <x-slot name="header">
                    @if($key == 0)
                    <div class="flex justify-between w-full">
                        <div>
                            <x-card-title> Emergency Contacts </x-card-title>
                        </div> 
                        <div class="">
                            @if(!$disableInputs)
                                <x-jet-secondary-button wire:click.prevent="$set('disableInputs', true)"  class="w-full">
                                    Cancel
                                </x-jet-secondary-button> 
                            @else
                                <x-jet-button wire:click.prevent="$set('disableInputs', false)"  class="w-full">
                                    <x-heroicon-o-pencil class="w-4 h-4" />
                                        Edit
                                </x-jet-button> 
                            @endif
                        </div>    
                    </div>
                    @else
                    <div class="flex justify-between w-full">
                        <div>
                            <x-card-title> Emergency Contacts </x-card-title>
                        </div>  
                    </div>
                    @endif
                </x-slot>
                <x-slot name="table">
                    <div class="bg-white grid grid-cols-2 mt-5">
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data-input label="Select Emergency Contact: " >
                                <x-forms.select
                                    label=""
                                    id="emergency_{{$key}}_contact_opt"
                                    :options="$newEmergencyContactFields['emergency_contact_opt']"
                                    placeholder="Select Emergency Contact"
                                    wire:model="newEmergencyContactFields.list_of_emergency_contact_registered.{{$key}}.selected_emergency_contact"
                                />
                            </x-list-data-input>
                        </div>    
                    </div>
                    <div>
                    @if($newEmergencyContactFields['list_of_emergency_contact_registered'][$key]['selected_emergency_contact'] == -1)
                    <div class="bg-white grid grid-cols-2">
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data-input label="First Name: " >
                                <x-jet-input
                                    id="emergency_contact_{{$key}}_first_name"
                                    type="text"
                                    class="block w-full"
                                    wire:model.defer="newEmergencyContactFields.list_of_emergency_contact_registered.{{$key}}.first_name"
                                    autocomplete="false"
                                    disabled={{$disableInputs}}
                                />
                            @error('newEmergencyContactFields.list_of_emergency_contact_registered.{{$key}}.first_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </x-list-data-input>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data-input label="Last Name: " >
                                <x-jet-input
                                    id="emergency_contact_{{$key}}_last_name"
                                    type="text"
                                    class="block w-full"
                                    wire:model.defer="newEmergencyContactFields.list_of_emergency_contact_registered.{{$key}}.last_name"
                                    autocomplete="false"
                                    disabled={{$disableInputs}}
                                />
                                @error('newEmergencyContactFields.list_of_emergency_contact_registered.{{$key}}.last_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </x-list-data-input>
                        </div>
                    </div>
                    <div class="bg-white grid grid-cols-2">
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data-input label="Contact's Phone Number: " >
                                <x-jet-input
                                    id="emergency_contact_{{$key}}_phone_number"
                                    type="text"
                                    class="block w-full"
                                    wire:model.defer="newEmergencyContactFields.list_of_emergency_contact_registered.{{$key}}.phone_number"
                                    autocomplete="false"
                                    disabled={{$disableInputs}}
                                />
                            @error('newEmergencyContactFields.list_of_emergency_contact_registered.{{$key}}.phone_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </x-list-data-input>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data-input label="Phone Type: " >
                                <x-forms.select
                                    id="emergency_contact_{{$key}}_phone_number_type"
                                    label=""
                                    :options="$newEmergencyContactFields['phone_type_opt']"
                                    placeholder="Select Phone Number Type"
                                    error=""
                                    wire:model.defer="newEmergencyContactFields.list_of_emergency_contact_registered.{{$key}}.phone_number_type"
                                    disabled={{$disableInputs}}
                                />
                                @error('newEmergencyContactFields.list_of_emergency_contact_registered.{{$key}}.phone_number_type') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </x-list-data-input>
                        </div>
                    </div>
                    @endif
                    </div>
                </x-slot>
            </x-card>
            </br>
            @endforeach

            @foreach($newEmergencyContactFields['list_of_authorized'] as $key =>  $item)
            <x-card>
                <x-slot name="header">
                    <x-card-title> <span class="h-8 w-8 rounded-full bg-green-100 flex flex-col items-center justify-center mr-2 font-semibold text-lg text-green-500"> {{count($newEmergencyContactFields['list_of_emergency_contact_registered'])+($key+1)}}</span>To Whom Child Will Be Released</x-card-title>
                </x-slot>
                <x-slot name="table">
                    <div class="bg-white grid grid-cols-2 mt-5">
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data-input label="Select Authorized Pickup: " >
                                <x-forms.select
                                    label=""
                                    id="emergency_{{$key}}_contact_opt"
                                    :options="$newEmergencyContactFields['emergency_contact_opt']"
                                    placeholder="Select Authorized Pickup"
                                    wire:model="newEmergencyContactFields.list_of_authorized.{{$key}}.selected_emergency_contact"
                                    disabled={{$disableInputs}}
                                />
                            </x-list-data-input>
                        </div>    
                    </div>
                    <div>
                    @if($newEmergencyContactFields['list_of_authorized'][$key]['selected_emergency_contact'] == -1)
                        <div class="bg-white grid grid-cols-2">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="First Name: " >
                                    <x-jet-input
                                        id="emergency_contact_{{$key}}_first_name"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="newEmergencyContactFields.list_of_authorized.{{$key}}.first_name"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('newEmergencyContactFields.list_of_authorized.{{$key}}.first_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Last Name: " >
                                    <x-jet-input
                                        id="emergency_contact_{{$key}}_last_name"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="newEmergencyContactFields.list_of_authorized.{{$key}}.last_name"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                    @error('newEmergencyContactFields.list_of_authorized.{{$key}}.last_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-2">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Contact's Phone Number: " >
                                    <x-jet-input
                                        id="emergency_contact_{{$key}}_phone_number"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="newEmergencyContactFields.list_of_authorized.{{$key}}.phone_number"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('newEmergencyContactFields.list_of_authorized.{{$key}}.phone_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Phone Type: " >
                                    <x-forms.select
                                        id="emergency_contact_{{$key}}_phone_number_type"
                                        label=""
                                        :options="$newEmergencyContactFields['phone_type_opt']"
                                        placeholder="Select Phone Number Type"
                                        error=""
                                        wire:model.defer="newEmergencyContactFields.list_of_authorized.{{$key}}.phone_number_type"
                                        disabled={{$disableInputs}}
                                    />
                                    @error('newEmergencyContactFields.list_of_authorized.{{$key}}.phone_number_type') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                    @endif
                    </div>
                </x-slot>
            </x-card>
            </br>
            @endforeach
            <x-card-action>
                <div>
                @if($disableInputs) 
                    <x-jet-button disabled>
                        Update
                    </x-jet-button> 
                @else 
                    <x-jet-button>
                        Update
                    </x-jet-button> 
                @endif   
                </div>
            </x-card-action>
            </form>
        </div> 
    </x-content>
</div>
