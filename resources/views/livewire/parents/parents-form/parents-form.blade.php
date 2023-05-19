<div>
    <x-header :title="'Parents Form'"/>
<x-notification />
<x-livewire-alert::scripts />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <x-livewire-alert::scripts />
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
        <div class="grid grid-cols-1 gap-4">
            <!-- Employee Personal Panel -->
            <x-card>
                    <x-slot name="header">
                        <x-card-title> Parents Details </x-card-title>
                    </x-slot>
                    <x-slot name="table">
                        <div class="bg-white grid grid-cols-2">
                            <div class="bg-white grid grid-cols-1">
                                 <x-list-data-input label="First Name: " >
                                        <x-jet-input
                                            id="first_name"
                                            type="text"
                                            class="block w-full"
                                            wire:model.defer="parentFields.first_name"
                                            autocomplete="false"
                                        />
                                        @error('parentFields.first_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                    </x-list-data-input>
                            </div>
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Last Name: " >
                                    <x-jet-input
                                        id="last_name"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="parentFields.last_name"
                                        autocomplete="false"
                                    />
                                @error('parentFields.last_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-2">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Phone Number 1: " >
                                    <x-jet-input
                                        id="phone_number_1"
                                        type="number"
                                        class="block w-full"
                                        wire:model.defer="parentFields.phone_number_1"
                                        autocomplete="false"
                                    />
                                @error('parentFields.phone_number_1') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Phone Type 1: " >
                                    <x-forms.select
                                        id="phone-number-type-1"
                                        label=""
                                        :options="$parentFields['phone_type_1_option']"
                                        placeholder="Select Phone Number Type"
                                        error=""
                                        wire:model.defer="parentFields.phone_type_1"
                                        
                                    />
                                @error('parentFields.phone_type_1') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-2">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Phone Number 2: " >
                                    <x-jet-input
                                        id="last_name"
                                        type="number"
                                        class="block w-full"
                                        wire:model.defer="parentFields.phone_number_2"
                                        autocomplete="false"
                                    />
                                </x-list-data-input>
                            </div>
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Phone Type 2: " >
                                    <x-forms.select
                                        id="phone-number-type-1"
                                        label=""
                                        :options="$parentFields['phone_type_2_option']"
                                        placeholder="Select Phone Number Type"
                                        error=""
                                        wire:model.defer="parentFields.phone_type_2"
                                        
                                    />
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-2">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Email Address: " >
                                    <x-jet-input
                                        id="email_address"
                                        type="email"
                                        class="block w-full"
                                        wire:model.defer="parentFields.email_address"
                                        autocomplete="false"
                                    />
                                @error('parentFields.email_address') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                            <div class="bg-white grid gridP-cols-1">
                                <x-list-data-input label="Profile Type: " >
                                    <x-forms.select
                                        id="profile-type"
                                        label=""
                                        :options="$parentFields['profile_type_option']"
                                        placeholder="Select Profile Type"
                                        error=""
                                        wire:model.defer="parentFields.profile_type"
                                    />
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-2">
                            <div class="bg-white grid grid-cols-1">
                            @if ( $edited && $showPassword )
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
                            @endif
                            </div>
                        </div>
                    </x-slot>
            </x-card>
            <x-card-action>
                <div>
                    <x-jet-button>
                        @if ( $edited )   
                            Update
                        @else 
                            Submit
                        @endif
                    </x-jet-button>    
                </div>
            </x-card-action>
        </div>
    </form>
</x-content>