<div>
    <x-staff-layout :user="$user" title="">
        <x-slot name="header">
            <x-link :href="route('staffs.profile.emergency-contact', $user)">
                <x-heroicon-o-arrow-narrow-left class="w-4 h-4 mr-2" />
                Go Back
            </x-link>
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="submit">
                <div class="grid grid-cols-1 gap-4">
                <!-- Employee Personal Panel -->
                    <x-card>
                        <x-slot name="header">
                            <x-card-title> Staff Emergency Contact Form </x-card-title>
                        </x-slot>
                        <x-slot name="table">
                            <div class="bg-white grid grid-cols-2">
                                <x-list-data label="Employee Name: " :value="$employee['employee_name']" wire:model="employee.employee_name"/>
                                <x-list-data label="Employee Title: " :value="$employee['employee_title']" wire:model="employee.employee_title"/>
                            </div>
                            <div class="bg-white grid grid-cols-2">
                                <x-list-data label="Address: " :value="$employee['address']" wire:model="employee.address"/>
                                <x-list-data label="Email Address: " :value="$employee['email_address']" wire:model="employee.email_address"/>
                            </div>
                            <div class="bg-white grid grid-cols-2">
                                <x-list-data label="Phone Number: " :value="$employee['phone_number']" wire:model="employee.phone_number"/>
                                <x-list-data label="Date of Birth: " :value="$employee['dob']" wire:model="employee.dob"/>
                            </div>
                        </x-slot>
                    </x-card>
                <!-- Emgergency Contact Form  Panel -->
                    @foreach ($emergencyContactFields['emergency_contact_details'] as $index => $item)
                            @if ( $index > 0 )
                                </br></br>
                            @endif
                        <x-card>
                                <x-slot name="header">
                                    <x-card-title> Emergency Contact #{{$index+1}} </x-card-title>
                                </x-slot>
                                <x-slot name="table">
                                    <div class="bg-white grid grid-cols-2">
                                        <x-list-data-input label="Emergency {{$index+1}} Contact Name: " >
                                            <x-jet-input
                                                id="employer"
                                                type="text"
                                                class="block w-full"
                                                wire:model.defer="emergencyContactFields.emergency_contact_details.{{$index}}.emergency_contact_name"
                                                autocomplete="false"
                                            />
                                        </x-list-data-input>
                                    </div>
                                        @error('emergencyContactFields.emergency_contact_details.'.$index.'.emergency_contact_name') <span class="text-red-500 ml-5">{{ $message }}</span> @enderror
                                    <div class="bg-white grid grid-cols-2">
                                        <div class="bg-white grid grid-cols-1">
                                            <x-list-data-input label="Emergency {{$index+1}} Home Phone: " >
                                            <x-jet-input
                                                id="job_title"
                                                type="text"
                                                class="block w-full"
                                                wire:model.defer="emergencyContactFields.emergency_contact_details.{{$index}}.emergency_home_phone"
                                                autocomplete="false"
                                            />
                                            </x-list-data-input>
                                                @error('emergencyContactFields.emergency_contact_details.'.$index.'.emergency_home_phone') <span class="text-red-500 ml-5">{{ $message }}</span> @enderror
                                            </div>
                                        <div class="bg-white grid grid-cols-1">
                                            <x-list-data-input label="Emergency {{$index+1}} Cell Phone: " >
                                            <x-jet-input
                                                id="job_title"
                                                type="text"
                                                class="block w-full"
                                                wire:model.defer="emergencyContactFields.emergency_contact_details.{{$index}}.emergency_cell_phone"
                                                autocomplete="false"
                                            />
                                            </x-list-data-input>
                                                @error('emergencyContactFields.emergency_contact_details.'.$index.'.emergency_cell_phone') <span class="text-red-500 ml-5">{{ $message }}</span> @enderror
                                        </div>
                                        
                                    </div>
                                    <div class="bg-white grid grid-cols-2">
                                        <div class="bg-white grid grid-cols-1">
                                            <x-list-data-input label="Emergency {{$index+1}} Work Phone: " >
                                            <x-jet-input
                                                id="job_title"
                                                type="text"
                                                class="block w-full"
                                                wire:model.defer="emergencyContactFields.emergency_contact_details.{{$index}}.emergency_work_phone"
                                                autocomplete="false"
                                            />
                                            </x-list-data-input>
                                                @error('emergencyContactFields.emergency_contact_details.'.$index.'.emergency_work_phone') <span class="text-red-500 ml-5">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="bg-white grid grid-cols-1">
                                            <x-list-data-input label="Emergency {{$index+1}} Relation to Staff: " >
                                            <x-jet-input
                                                id="job_title"
                                                type="text"
                                                class="block w-full"
                                                wire:model.defer="emergencyContactFields.emergency_contact_details.{{$index}}.emergency_relation_to_staff"
                                                autocomplete="false"
                                            />
                                            </x-list-data-input>
                                                @error('emergencyContactFields.emergency_contact_details.'.$index.'.emergency_relation_to_staff') <span class="text-red-500 ml-5">{{ $message }}</span> @enderror
                                            </div>
                                    </div>
                                </x-slot>
                        </x-card>
                    @endforeach
                <!-- Health Information Panel -->
                    <x-card>
                            <x-slot name="header">
                                <x-card-title> Health Information </x-card-title>
                            </x-slot>
                            <x-slot name="table">
                                <div class="bg-white grid grid-cols-2">
                                    <x-list-data-input label="Staff Allergies:" >
                                        <x-jet-input
                                            id="hours_available_for_work"
                                            type="text"
                                            class="block w-full"
                                            wire:model.defer="emergencyContactFields.staff_allergies"
                                            autocomplete="false"
                                        />
                                        @error('emergencyContactFields.staff_allergies') <span class="text-red-500 ">{{ $message }}</span> @enderror
                                    </x-list-data-input>
                                </div>
                                <div class="bg-white grid grid-cols-2">
                                    <x-list-data-input label="Staff Reactions to allergies:" >
                                        <x-jet-input
                                            id="hours_available_for_work"
                                            type="text"
                                            class="block w-full"
                                            wire:model.defer="emergencyContactFields.staff_reaction_allergies"
                                            autocomplete="false"
                                        />
                                        @error('emergencyContactFields.staff_reaction_allergies') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </x-list-data-input>
                                </div>
                                <div class="bg-white grid grid-cols-2">
                                    <x-list-data-input label="Staff Medication:" >
                                        <x-jet-input
                                            id="hours_available_for_work"
                                            type="text"
                                            class="block w-full"
                                            wire:model.defer="emergencyContactFields.staff_medication"
                                            autocomplete="false"
                                        />
                                        @error('emergencyContactFields.staff_medication') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </x-list-data-input>
                                </div>
                                <div class="bg-white grid grid-cols-2">
                                    <x-list-data-input label="Staff Medical Conditions:" >
                                        <x-jet-input
                                            id="hours_available_for_work"
                                            type="text"
                                            class="block w-full"
                                            wire:model.defer="emergencyContactFields.staff_medical_conditions"
                                            autocomplete="false"
                                        />
                                    </x-list-data-input>
                                </div>
                                <div class="bg-white grid grid-cols-2">
                                    <x-list-data-input label="Actions Needed to Medical Conditions:" >
                                        <x-jet-input
                                            id="hours_available_for_work"
                                            type="text"
                                            class="block w-full"
                                            wire:model.defer="emergencyContactFields.actions_needed_to_medical_conditions"
                                            autocomplete="false"
                                        />
                                    </x-list-data-input>
                                </div>
                                <div class="bg-white grid grid-cols-2">
                                    <x-list-data-input label="Medical Insurance (Staff):" >
                                        <x-jet-input
                                            id="hours_available_for_work"
                                            type="text"
                                            class="block w-full"
                                            wire:model.defer="emergencyContactFields.staff_medical_insurance"
                                            autocomplete="false"
                                        />
                                    </x-list-data-input>
                                </div>
                                <div class="bg-white grid grid-cols-2">
                                    <x-list-data-input label="Policy Number (Staff):" >
                                        <x-jet-input
                                            id="hours_available_for_work"
                                            type="text"
                                            class="block w-full"
                                            wire:model.defer="emergencyContactFields.staff_policy_number"
                                            autocomplete="false"
                                        />
                                    </x-list-data-input>
                                </div>
                            </x-slot>
                    </x-card>
                    <div class="flex">
                        <div class="flex justify-end  w-full">
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox" name="remember" wire:model.defer="emergencyContactFields.completed">
                                <span class="ml-2 text-sm text-gray-600">Set as completed</span>
                            </label>
                        </div>
                    </div>
                    <x-card-action>
                        <div>
                            <x-jet-button>
                                @if ( $edited > 0)   
                                    Update
                                @else 
                                    Save
                                @endif
                            </x-jet-button>    
                        </div>
                    </x-card-action>
            </form>
        </x-slot>
    </x-staff-layout>
    </div>