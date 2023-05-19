<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        My Account Information
    </x-slot>

    <x-slot name="description">
        Update your account's information and email address.
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="Photo" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" class="rounded-full h-20 w-20">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    Select A New Photo
                </x-jet-secondary-button>

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- First Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="first_name" value="First Name" />
            <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model.defer="state.first_name" autocomplete="first_name" />
            <x-jet-input-error for="first_name" class="mt-2" />
        </div>

         <!-- Last Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="last_name" value="Last Name" />
            <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="state.last_name" autocomplete="last_name" />
            <x-jet-input-error for="last_name" class="mt-2" />
        </div>
            
        <!-- Contact number -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="phone_number" value="Phone Number" />
            <x-jet-input id="phone_number" type="text" class="mt-1 block w-full" wire:model.defer="state.phone_number" autocomplete="phone_number" />
            <x-jet-input-error for="phone_number" class="mt-2" />
        </div>

        <!-- Contact Type -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="phone_type_1_option" value="Phone Type" />
            <x-forms.select
                id="phone_type_1"
                label=""
                :options="$parentFields['phone_type_1_option']"
                placeholder="Select Phone Type"
                error=""
                wire:model.defer="state.phone_type_1"
                
            />
            @error('parentFields.phone_type_1_option') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </div>
        
        <!-- Address -->
        <!-- <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="address" value="Address" />
            <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="state.address" />
            <x-jet-input-error for="address" class="mt-2" />
        </div> -->

        <!-- City -->
        <!-- <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="city" value="City" />
            <x-jet-input id="city" type="text" class="mt-1 block w-full" wire:model.defer="state.city" />
            <x-jet-input-error for="city" class="mt-2" />
        </div> -->

        <!-- state -->
        <!-- <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="state" value="State" />
            <x-jet-input id="state" type="text" class="mt-1 block w-full" wire:model.defer="state.state" />
            <x-jet-input-error for="email" class="mt-2" />
        </div> -->

        <!-- zip -->
        <!-- <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="zip" value="Zip" />
            <x-jet-input id="zip" type="text" class="mt-1 block w-full" wire:model.defer="state.zip" />
            <x-jet-input-error for="email" class="mt-2" />
        </div> -->

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="Email" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

         <div class="col-span-6 sm:col-span-4">
            <x-forms.roles
                model="state.role"
            />
            <x-jet-input-error for="state.role" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            Saved.
        </x-jet-action-message>

        <x-jet-button>
            Save
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
