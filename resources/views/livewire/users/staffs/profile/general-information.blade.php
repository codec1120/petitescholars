<x-staff-layout :user="$user" title="General Information">
    <x-slot name="content">
        @foreach ($generalInfos as $label => $value)
            <x-list-data
                :label="$label"
                :value="$value"
            />
        @endforeach
    </x-slot>
    <x-slot name="actions">
       <div>
            <x-jet-button wire:click="$set('editing', true)" wire:loading.attr="disabled">
                <x-heroicon-o-pencil class="w-4 h-4 mr-2" />
                Edit
            </x-jet-button>
            <x-jet-modal :id="'edit-general-information'" wire:model="editing">
                <form wire:submit.prevent="submit">
                    <div class="px-6 py-4">
                        <div class="text-base md:text-lg font-semibold">
                            Update General Information
                        </div>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6 overflow-y-scroll sm:overflow-hidden h-96 sm:h-full">
                            <div>
                                <x-jet-label for="staff_name" value="Staff Name" />
                                <x-jet-input
                                    id="staff_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    wire:model.defer="generalInfoFields.staff_name"
                                    autocomplete="staff_name"
                                />
                            </div>
                            <div>
                                <x-forms.select
                                    id="title-selector"
                                    label="Title"
                                    :options="App\Models\StaffTitle::get()->transform(
                                        fn ($role) => [
                                            'label' => $role->name,
                                            'value' => $role->value
                                        ]
                                    )"
                                    placeholder="Select Title"
                                    error=""
                                    wire:model.defer="generalInfoFields.title"
                                />
                            </div>
                            <div>
                                <x-jet-label for="dob" value="DOB" />
                                 <x-pikaday
                                    name="dob"
                                    format="MM/DD/YYYY"
                                    autocomplete="off"
                                    wire:model.lazy="generalInfoFields.dob"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="phone_nubmer" value="Phone Number" />
                                <x-jet-input
                                    id="phone_number"
                                    type="text"
                                    class="mt-1 block w-full"
                                    wire:model.defer="generalInfoFields.phone_number"
                                    autocomplete="phone_number"
                                />
                            </div>
                            <div>
                                <x-jet-label for="address" value="Address" />
                                <x-jet-input
                                    id="address"
                                    type="text"
                                    class="mt-1 block w-full"
                                    wire:model.defer="generalInfoFields.address"
                                    autocomplete="address"
                                />
                            </div>
                            <div>
                                <x-jet-label for="city" value="City" />
                                <x-jet-input
                                    id="city"
                                    type="text"
                                    class="mt-1 block w-full"
                                    wire:model.defer="generalInfoFields.city"
                                    autocomplete="city"
                                />
                            </div>
                            <div>
                                <x-jet-label for="zip" value="Zip" />
                                <x-jet-input
                                    id="zip"
                                    type="text"
                                    class="mt-1 block w-full"
                                    wire:model.defer="generalInfoFields.zip"
                                    autocomplete="zip"
                                />
                            </div>
                            <div>
                                <x-jet-label for="state" value="State" />
                                <x-jet-input
                                    id="state"
                                    type="text"
                                    class="mt-1 block w-full"
                                    wire:model.defer="generalInfoFields.state"
                                    autocomplete="state"
                                />
                            </div>
                            <div>
                                <x-jet-label for="doh" value="DOH" />
                                 <x-pikaday
                                    name="doh"
                                    format="MM/DD/YYYY"
                                    autocomplete="off"
                                    wire:model.lazy="generalInfoFields.doh"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="first_date_in_child_care" value="First Date in Child Care" />
                                 <x-pikaday
                                    name="first_date_in_child_care"
                                    format="MM/DD/YYYY"
                                    autocomplete="off"
                                    wire:model.lazy="generalInfoFields.first_date_in_child_care"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="pd_registry" value="PD Registry" />
                                <x-jet-input
                                    id="pd_registry"
                                    type="text"
                                    class="mt-1 block w-full"
                                    wire:model.defer="generalInfoFields.pd_registry"
                                    autocomplete="pd_registry"
                                />
                            </div>
                        </div>
                    </div>
                    <x-card-action>
                        <div>
                            <x-jet-secondary-button wire:click="$set('editing', false)">
                                Close
                            </x-jet-secondary-button>
                            <x-jet-button>
                                Save
                            </x-jet-button>
                        </div>
                    </x-card-action>
                </form>
            </x-jet-modal>
       </div>
    </x-slot>
</x-staff-layout>