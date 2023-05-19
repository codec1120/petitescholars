<div class="bg-white grid grid-cols-1 p-5">
    <span class="font-bold">Authorized Adult</span>
</div>
<div class="bg-white grid grid-cols-2">
    <div class="bg-white grid grid-cols-1">
        <x-list-data-input label="First Name: " >
            <x-jet-input
                id="auth_first_name"
                type="text"
                class="block w-full"
                wire:model.defer="authAdultFields.first_name"
                autocomplete="false"
            />
        @error('authAdultFields.first_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </x-list-data-input>
    </div>
    <div class="bg-white grid grid-cols-1">
        <x-list-data-input label="Last Name: " >
            <x-jet-input
                id="auth_last_name"
                type="text"
                class="block w-full"
                wire:model.defer="authAdultFields.last_name"
                autocomplete="false"
            />
            @error('authAdultFields.first_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </x-list-data-input>
    </div>
</div>
<div class="bg-white grid grid-cols-2">
    <div class="bg-white grid grid-cols-1">
        <x-list-data-input label="Phone Number: " >
            <x-jet-input
                id="auth_phone_number"
                type="number"
                class="block w-full"
                wire:model.defer="authAdultFields.phone_number"
                autocomplete="false"
            />
        </x-list-data-input>
    </div>
</div>
<!-- <div class="bg-white grid grid-cols-1 p-5">
    <span class="">Does the child live in a one-parent home?</span>
    <div class="mt-2">
        <label class="inline-flex items-center">
            <input type="radio" class="form-radio" wire:model.defer="authAdultFields.childLiveInParentHome" name="childLiveInParentHome" value="yes" checked />
        <span class="ml-2">Yes</span>
        </label>
        <label class="inline-flex items-center ml-6">
            <input type="radio" class="form-radio" wire:model.defer="authAdultFields.childLiveInParentHome" name="childLiveInParentHome" value="no"/>
        <span class="ml-2">No</span>
        </label>
    </div>
</div> -->
@if ( $authAdultFields['childLiveInParentHome'] == 'yes' )
    <div class="bg-white grid grid-cols-1 p-5">
        <span class="">Does information need to be sent to an absentee parent?</span>
        <div class="mt-2">
            <label class="inline-flex items-center">
                <input type="radio" class="form-radio" wire:model.defer="authAdultFields.infoSentToAbsenteeParent" name="infoSentToAbsenteeParent" value="yes" checked />
            <span class="ml-2">Yes</span>
            </label>
            <label class="inline-flex items-center ml-6">
                <input type="radio" class="form-radio" wire:model.defer="authAdultFields.infoSentToAbsenteeParent" name="infoSentToAbsenteeParent" value="no"/>
            <span class="ml-2">No</span>
            </label>
        </div>
    </div>
    @if ( $authAdultFields['infoSentToAbsenteeParent'] == 'yes' )
        <div class="bg-white grid grid-cols-1 p-5">
            <span class="font-bold">Absentee </span>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="First Name: " >
                    <x-jet-input
                        id="absentee_first_name"
                        type="text"
                        class="block w-full"
                        wire:model.defer="authAdultFields.absentee_first_name"
                        autocomplete="false"
                    />
                @error('authAdultFields.absentee_first_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Last Name: " >
                    <x-jet-input
                        id="absentee_last_name"
                        type="text"
                        class="block w-full"
                        wire:model.defer="authAdultFields.absentee_last_name"
                        autocomplete="false"
                    />
                    @error('authAdultFields.absentee_last_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Phone Number: " >
                    <x-jet-input
                        id="absentee_phone_number"
                        type="number"
                        class="block w-full"
                        wire:model.defer="authAdultFields.absentee_phone_number"
                        autocomplete="false"
                    />
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Address: " >
                    <x-jet-input
                        id="absentee_address"
                        type="text"
                        class="block w-full"
                        wire:model.defer="authAdultFields.absentee_address"
                        autocomplete="false"
                    />
                </x-list-data-input>
            </div>
        </div>
    @endif
@endif