<div class="col-span-8 sm:col-span-6">
<!-- Childcare Section -->
<x-card>
    <x-slot name="table">
        <x-slot name="header">
            <x-card-title> Child Information </x-card-title>
        </x-slot>
        <!-- <div class="bg-white grid grid-cols-1 p-5">
            <span class="font-semibold text-lg text-red-500"> Please Complete the Childs information to proceed.</span>
        </div> -->
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="First Name: " >
                    <x-jet-input
                        id="child_first_name"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childrenFields.first_name"
                        autocomplete="false"
                    />
                @if($errors->has('first_name')) <span class="error" style="color:red">{{ $errors->first('first_name') }}</span> @endif
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Last Name: " >
                    <x-jet-input
                        id="child_last_name"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childrenFields.last_name"
                        autocomplete="false"
                    />
                @if($errors->has('last_name')) <span class="error" style="color:red">{{ $errors->first('last_name') }}</span> @endif
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Birthdate: " >
                    <x-jet-input
                        id="birthdate"
                        type="date"
                        class="block w-full"
                        wire:model.lazy="childrenFields.birthdate"
                        autocomplete="false"
                        wire:change="caculateAge()"
                    />
                @if($errors->has('birthdate')) <span class="error" style="color:red">{{ $errors->first('birthdate') }}</span> @endif
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Age: " >
                    <x-jet-input
                        id="age"
                        type="number"
                        class="block w-full"
                        wire:model.defer="childrenFields.age"
                        autocomplete="false"
                        disabled="true"
                    />
                    @if($errors->has('age')) <span class="error" style="color:red">{{ $errors->first('age') }}</span> @endif
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Sex: " >
                    <x-forms.select
                        id="sex"
                        label=""
                        :options="$childrenFields['gender_option']"
                        placeholder="Select Gender"
                        error=""
                        wire:model.defer="childrenFields.sex"
                    />
                @if($errors->has('sex')) <span class="error" style="color:red">{{ $errors->first('sex') }}</span> @endif
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Address: " >
                    <x-jet-input
                        id="home_address"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childrenFields.home_address"
                        autocomplete="false"
                    />
                @if($errors->has('home_address')) <span class="error" style="color:red">{{ $errors->first('home_address') }}</span> @endif
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="City: " >
                    <x-jet-input
                        id="city"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childrenFields.city"
                        autocomplete="false"
                    />
                @if($errors->has('city')) <span class="error" style="color:red">{{ $errors->first('city') }}</span> @endif
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="State: " >
                    <x-jet-input
                        id="state"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childrenFields.state"
                        autocomplete="false"
                    />
                @if($errors->has('state')) <span class="error" style="color:red">{{ $errors->first('state') }}</span> @endif
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <x-list-data-input label="Zip: " >
                <x-jet-input
                    id="zip"
                    type="number"
                    class="block w-full"
                    wire:model.defer="childrenFields.zip"
                    autocomplete="false"
                />
            @if($errors->has('zip')) <span class="error" style="color:red">{{ $errors->first('zip') }}</span> @endif
            </x-list-data-input>
        </div>
    </x-slot>
</x-card>  
<!-- Parent's info Section -->
</br>
@if(!is_null($childrenFields['first_name']) && !is_null($childrenFields['last_name']))
<!-- Mother's info Section -->
<x-card>
    <x-slot name="table">
        <x-slot name="header">
            <x-card-title> <span class="h-8 w-8 rounded-full bg-green-100 flex flex-col items-center justify-center mr-2 font-semibold text-lg text-green-500"> 2</span> Child's Mother </x-card-title>
        </x-slot>
        <div class="bg-white grid grid-cols-2">
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Mother's First Name: " >
                    <x-jet-input
                        id="mothers_first_name"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_mother.first_name"
                        autocomplete="false"
                    />
                @error('childs_mother.first_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Mother's Last Name: " >
                    <x-jet-input
                        id="mothers_last_name"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_mother.last_name"
                        autocomplete="false"
                    />
                    @error('childs_mother.last_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Mother's Email: " >
                    <x-jet-input
                        id="mothers_email"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_mother.email"
                        autocomplete="false"
                    />
                @error('childs_mother.email') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Mother's Phone: " >
                    <x-jet-input
                        id="mothers_phone"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_mother.phone"
                        autocomplete="false"
                    />
                @error('childs_mother.phone') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Phone Type: " >
                    <x-forms.select
                        id="mothers_phone_type"
                        label=""
                        :options="$childs_mother['phone_type_option']"
                        placeholder="Select Phone Number Type"
                        error=""
                        wire:model.defer="childs_mother.phone_type"
                    />
                    @error('childs_mother.phone_type') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Mother's Home Address: " >
                    <x-jet-input
                        id="mothers_home_address"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_mother.home_address"
                        autocomplete="false"
                        disabled={{$motherSameAsChildAddress}}
                    />
                @error('childs_mother.home_address') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="City: " >
                <x-jet-input
                        id="home_city"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_mother.home_city"
                        autocomplete="false"
                        disabled={{$motherSameAsChildAddress}}
                    />
                    @error('childs_mother.home_city') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-1">
            <div class="bg-white grid grid-cols-1">
                <x-input.checkbox class="ml-5" wire:click="setAsChildHomeAddressForMother" wire:model="childs_mother.sameAsChildAddress">
                    <span class="ml-2">Same as Child's home address</span>
                </x-input.checkbox>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="State: " >
                    <x-jet-input
                        id="home_state"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_mother.home_state"
                        autocomplete="false"
                        disabled={{$motherSameAsChildAddress}}
                    />
                @error('childs_mother.home_state') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Zip: " >
                <x-jet-input
                        id="home_zip"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_mother.home_zip"
                        autocomplete="false"
                        disabled={{$motherSameAsChildAddress}}
                    />
                    @error('childs_mother.home_zip') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Business/Employer: " >
                    <x-jet-input
                        id="businesss_employer"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_mother.businesss_employer"
                        autocomplete="false"
                    />
                @error('childs_mother.businesss_employer') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Work Phone: " >
                <x-jet-input
                        id="work_phone"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_mother.work_phone"
                        autocomplete="false"
                    />
                    @error('childs_mother.work_phone') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Work Address: " >
                    <x-jet-input
                        id="work_address"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_mother.work_address"
                        autocomplete="false"
                    />
                @error('childs_mother.work_address') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Work City: " >
                <x-jet-input
                        id="work_city"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_mother.work_city"
                        autocomplete="false"
                    />
                    @error('childs_mother.work_city') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Work State: " >
                    <x-jet-input
                        id="work_state"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_mother.work_state"
                        autocomplete="false"
                    />
                @error('childs_mother.work_address') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Work Zip: " >
                <x-jet-input
                        id="work_zip"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_mother.work_zip"
                        autocomplete="false"
                    />
                    @error('childs_mother.work_zip') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2 p-5">
            <div class="bg-white grid grid-cols-1">
                <x-input.checkbox class="ml-5" wire:click="setMotherPrimary" wire:model="childs_mother.primary_guardian">
                    <span class="ml-2">This is {{$childrenFields['first_name'].' '.$childrenFields['last_name']}}'s <span class="font-bold">Primary Guardian</span> </span>
                </x-input.checkbox>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-input.checkbox class="ml-5" wire:click="setMotherSecondary" wire:model="childs_mother.secondary_guardian">
                    <span class="ml-2">This is {{$childrenFields['first_name'].' '.$childrenFields['last_name']}}'s <span class="font-bold">Secondary Guardian</span> </span>
                </x-input.checkbox>
            </div>
        </div>
        <!-- @if($childs_mother['primary_guardian'])
        <div class="bg-white grid grid-cols-1 p-5">
            <span class="font-semibold text-lg text-red-500"> NOTE: A parent set as a PRIMARY GUARDIAN must have an account with Petite Scholars. If the parent does not have an account with ﻿Petite Scholars, an account will automatically be created.</span>
        </div>
        @endif -->
    </x-slot>
</x-card>
<!-- Father's info Section -->
</br>
<x-card>
    <x-slot name="table">
        <x-slot name="header">
            <x-card-title> <span class="h-8 w-8 rounded-full bg-green-100 flex flex-col items-center justify-center mr-2 font-semibold text-lg text-green-500"> 3</span> Child's Father </x-card-title>
        </x-slot>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Father's First Name: " >
                    <x-jet-input
                        id="fathers_first_name"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_father.first_name"
                        autocomplete="false"
                    />
                @error('childs_father.first_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Father's Last Name: " >
                    <x-jet-input
                        id="fathers_last_name"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_father.last_name"
                        autocomplete="false"
                    />
                    @error('childs_father.last_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Father's Email: " >
                    <x-jet-input
                        id="fathers_email"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_father.email"
                        autocomplete="false"
                    />
                @error('childs_father.email') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Father's Phone: " >
                    <x-jet-input
                        id="fathers_phone"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_father.phone"
                        autocomplete="false"
                    />
                @error('childs_father.phone') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Father's Phone Type: " >
                    <x-forms.select
                        id="fathers_phone_type"
                        label=""
                        :options="$childs_father['phone_type_option']"
                        placeholder="Select Phone Number Type"
                        error=""
                        wire:model.defer="childs_father.phone_type"
                    />
                    @error('childs_father.phone_type') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Fathers's Home Address: " >
                    <x-jet-input
                        id="fathers_home_address"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_father.home_address"
                        autocomplete="false"
                        disabled={{$fatherSameAsChildAddress}}
                    />
                @error('childs_father.home_address') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="City: " >
                <x-jet-input
                        id="fathers_home_city"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_father.home_city"
                        autocomplete="false"
                        disabled={{$fatherSameAsChildAddress}}
                    />
                    @error('childs_father.home_city') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-1">
            <div class="bg-white grid grid-cols-1">
                <x-input.checkbox class="ml-5" wire:click="setAsChildHomeAddressForFather" wire:model="childs_father.sameAsChildAddress">
                    <span class="ml-2">Same as Child's home address</span>
                </x-input.checkbox>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="State: " >
                    <x-jet-input
                        id="fathers_home_state"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_father.home_state"
                        autocomplete="false"
                        disabled={{$fatherSameAsChildAddress}}
                    />
                @error('childs_father.home_state') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Zip: " >
                <x-jet-input
                        id="fathers_home_zip"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_father.home_zip"
                        autocomplete="false"
                        disabled={{$fatherSameAsChildAddress}}
                    />
                    @error('childs_father.home_zip') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Business/Employer: " >
                    <x-jet-input
                        id="businesss_employer"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_father.businesss_employer"
                        autocomplete="false"
                    />
                @error('childs_father.businesss_employer') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Work Phone: " >
                <x-jet-input
                        id="work_phone"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_father.work_phone"
                        autocomplete="false"
                    />
                    @error('childs_father.work_phone') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Work Address: " >
                    <x-jet-input
                        id="fathers_work_address"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_father.work_address"
                        autocomplete="false"
                    />
                @error('childs_father.work_address') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Work City: " >
                <x-jet-input
                        id="fathers_work_city"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_father.work_city"
                        autocomplete="false"
                    />
                    @error('childs_father.work_city') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2">
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Work State: " >
                    <x-jet-input
                        id="fathers_work_state"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_father.work_state"
                        autocomplete="false"
                    />
                @error('childs_father.work_address') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-list-data-input label="Work Zip: " >
                <x-jet-input
                        id="fathers_work_zip"
                        type="text"
                        class="block w-full"
                        wire:model.defer="childs_father.work_zip"
                        autocomplete="false"
                    />
                    @error('childs_father.work_zip') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </x-list-data-input>
            </div>
        </div>
        <div class="bg-white grid grid-cols-2 p-5">
            <div class="bg-white grid grid-cols-1">
                <x-input.checkbox class="ml-5" wire:click="setFatherPrimary()" wire:model="childs_father.primary_guardian">
                    <span class="ml-2">This is {{$childrenFields['first_name'].' '.$childrenFields['last_name']}}'s <span class="font-bold">Primary Guardian</span> </span>
                </x-input.checkbox>
            </div>
            <div class="bg-white grid grid-cols-1">
                <x-input.checkbox class="ml-5" wire:click="setFatherSecondary()" wire:model="childs_father.secondary_guardian">
                    <span class="ml-2">This is {{$childrenFields['first_name'].' '.$childrenFields['last_name']}}'s <span class="font-bold">Secondary Guardian</span> </span>
                </x-input.checkbox>
            </div>
        </div>
        <!-- @if($childs_father['primary_guardian'])
        <div class="bg-white grid grid-cols-1 p-5">
            <span class="font-semibold text-lg text-red-500"> NOTE: A parent set as a PRIMARY GUARDIAN must have an account with Petite Scholars. If the parent does not have an account with ﻿Petite Scholars, an account will automatically be created.</span>
        </div>
        @endif -->
    </x-slot>
    <x-slot name="actions">
        <button type="button" 
            wire:click="saveChildrenInfo()"
            class="inline-flex items-center justify-center p-2 rounded-md text-green-400 hover:text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-500 transition duration-150 ease-in-out">
            Save
        </button>
    </x-slot>
</x-card>
@endif

</div>