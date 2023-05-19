<div class="bg-white grid grid-cols-2">
    <div class="bg-white grid grid-cols-1">
        <x-list-data-input label="First Name: " >
            <x-jet-input
                id="first_name"
                type="text"
                class="block w-full"
                wire:model.defer="secondaryGuardianFields.first_name"
                autocomplete="false"
            />
        @error('secondaryGuardianFields.first_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </x-list-data-input>
    </div>
    <div class="bg-white grid grid-cols-1">
        <x-list-data-input label="Last Name: " >
            <x-jet-input
                id="last_name"
                type="text"
                class="block w-full"
                wire:model.defer="secondaryGuardianFields.last_name"
                autocomplete="false"
            />
        @error('secondaryGuardianFields.last_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </x-list-data-input>
    </div>
</div>
<div class="bg-white grid grid-cols-2">
    <div class="bg-white grid grid-cols-1">
        <x-list-data-input label="Email Address: " >
            <x-jet-input
                id="email"
                type="email"
                class="block w-full"
                wire:model.defer="secondaryGuardianFields.email_address"
                autocomplete="false"
            />
        </x-list-data-input>
    </div>
</div>

<div class="bg-white grid grid-cols-2">
    <div class="bg-white grid grid-cols-1">
        <x-list-data-input label="Phone Number: " >
            <x-jet-input
                id="phone_number_1"
                type="number"
                class="block w-full"
                wire:model.defer="secondaryGuardianFields.phone_number_1"
                autocomplete="false"
            />
        </x-list-data-input>
    </div>
    <div class="bg-white grid grid-cols-1">
        <x-list-data-input label="Phone Type: " >
            <x-forms.select
                id="phone-number-type-1"
                label=""
                :options="$secondaryGuardianFields['phone_type_1_option']"
                placeholder="Select Phone Number Type"
                error="secondaryGuardianFields.phone_type_1"
                wire:model.defer="secondaryGuardianFields.phone_type_1"
            />
        </x-list-data-input>
    </div>
</div>
<div class="bg-white grid grid-cols-2">
    <div class="bg-white grid grid-cols-1">
        <x-input.checkbox class="ml-5" wire:click="setAsChildHomeAddressSecondaryGuardian()" wire:model.defer="sameAsChildAddressSecondary">
            <span class="ml-2">Same as Child's home address</span>
        </x-input.checkbox>
    </div>
</div>
<div class="bg-white grid grid-cols-2">
    <div class="bg-white grid grid-cols-1">
        <x-list-data-input label="Address: " >
            <x-jet-input
                id="home_address"
                type="text"
                class="block w-full"
                wire:model.defer="secondaryGuardianFields.home_address"
                autocomplete="false"
                disabled={{$sameAsChildAddressSecondary}}
            />
        </x-list-data-input>
    </div>
    <div class="bg-white grid grid-cols-1">
        <x-list-data-input label="City: " >
            <x-jet-input
                id="city"
                type="text"
                class="block w-full"
                wire:model.defer="secondaryGuardianFields.city"
                autocomplete="false"
                disabled={{$sameAsChildAddressSecondary}}
            />
        </x-list-data-input>
    </div>
</div>
<div class="bg-white grid grid-cols-2">
    <div class="bg-white grid grid-cols-1">
        <x-list-data-input label="State: " >
            <x-jet-input
                id="state"
                type="text"
                class="block w-full"
                wire:model.defer="secondaryGuardianFields.state"
                autocomplete="false"
                disabled={{$sameAsChildAddressSecondary}}
            />
        </x-list-data-input>
    </div>
    <div class="bg-white grid grid-cols-1">
        <x-list-data-input label="zip: " >
            <x-jet-input
                id="zip"
                type="text"
                class="block w-full"
                wire:model.defer="secondaryGuardianFields.zip"
                autocomplete="false"
                disabled={{$sameAsChildAddressSecondary}}
            />
        </x-list-data-input>
    </div>
</div>