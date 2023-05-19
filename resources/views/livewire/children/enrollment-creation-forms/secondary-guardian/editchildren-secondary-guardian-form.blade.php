<div class="bg-white grid grid-cols-2">
    <x-list-data wire:key="secondary_first_name" label="First Name: " :value="$guardianFirstName" />
    <x-list-data wire:key="secondary_last_name" label="Last Name: " :value="$guardianLastName" />
</div>
<div class="bg-white grid grid-cols-2">
    <x-list-data wire:key="secondary_email_address" label="Email Address: " :value="$guardianEmail" />
</div>

<div class="bg-white grid grid-cols-2">
    <div class="bg-white grid grid-cols-1">
        <x-list-data-input label="Phone Number 1: " >
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
        <x-list-data-input label="Phone Type 1: " >
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
        <x-input.checkbox class="ml-5" wire:click="setAsChildHomeAddressSecondaryGuardian()" wire:model="sameAsChildAddressSecondary">
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