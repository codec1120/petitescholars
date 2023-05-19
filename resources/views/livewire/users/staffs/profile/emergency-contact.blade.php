@if ( $viewForm )
<x-staff-layout :user="$user" title="Employee Data Sheet" :layout="'full'">
        <div>
            <x-link :href="route('staffs.profile.emergency-contact', $user)">
                <x-heroicon-o-arrow-narrow-left class="w-4 h-4 mr-2" />
                Go Back
            </x-link>
        </div>
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
                                    <x-list-data label="Location: " :value="$employee['location']" wire:model="employee.location"/>
                                    <x-list-data label="Email Address: " :value="$employee['email_address']" wire:model="employee.email_address"/>
                                </div>
                                <div class="bg-white grid grid-cols-2">
                                    <x-list-data label="Address: " :value="$employee['address']" wire:model="employee.address"/>
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
                                            <x-list-data label="Emergency {{$index+1}} Contact Name: " :value="$emergencyContactFields['emergency_contact_details'][$index]['emergency_contact_name']" wire:model="emergencyContactFields.emergency_contact_details.{{$index}}.emergency_contact_name"/>
                                        </div>
                                            @error('emergencyContactFields.emergency_contact_details.'.$index.'.emergency_contact_name') <span class="text-red-500 ml-5">{{ $message }}</span> @enderror
                                        <div class="bg-white grid grid-cols-2">
                                            <div class="bg-white grid grid-cols-1">
                                                    <x-list-data label="Emergency {{$index+1}} Home Phone: " :value="$emergencyContactFields['emergency_contact_details'][$index]['emergency_home_phone']" wire:model="emergencyContactFields.emergency_contact_details.{{$index}}.emergency_home_phone"/>
                                                    @error('emergencyContactFields.emergency_contact_details.'.$index.'.emergency_home_phone') <span class="text-red-500 ml-5">{{ $message }}</span> @enderror
                                                </div>
                                            <div class="bg-white grid grid-cols-1">
                                                    <x-list-data label="Emergency {{$index+1}} Cell Phone: " :value="$emergencyContactFields['emergency_contact_details'][$index]['emergency_cell_phone']" wire:model="emergencyContactFields.emergency_contact_details.{{$index}}.emergency_cell_phone"/>
                                                    @error('emergencyContactFields.emergency_contact_details.'.$index.'.emergency_cell_phone') <span class="text-red-500 ml-5">{{ $message }}</span> @enderror
                                            </div>
                                            
                                        </div>
                                        <div class="bg-white grid grid-cols-2">
                                            <div class="bg-white grid grid-cols-1">
                                                    <x-list-data label="Emergency {{$index+1}} Work Phone: " :value="$emergencyContactFields['emergency_contact_details'][$index]['emergency_work_phone']" wire:model="emergencyContactFields.emergency_contact_details.{{$index}}.emergency_work_phone"/>
                                                    @error('emergencyContactFields.emergency_contact_details.'.$index.'.emergency_work_phone') <span class="text-red-500 ml-5">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="bg-white grid grid-cols-1">
                                                    <x-list-data label="Emergency {{$index+1}} Relation to Staff: " :value="$emergencyContactFields['emergency_contact_details'][$index]['emergency_relation_to_staff']" wire:model="emergencyContactFields.emergency_contact_details.{{$index}}.emergency_relation_to_staff"/>
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
                                        <x-list-data label="Staff Allergies: " :value="$emergencyContactFields['staff_allergies']" wire:model="emergencyContactFields.staff_allergies"/>
                                    </div>
                                    <div class="bg-white grid grid-cols-2">
                                        <x-list-data label="Staff Reactions to allergies: " :value="$emergencyContactFields['staff_reaction_allergies']" wire:model="emergencyContactFields.staff_reaction_allergies"/>
                                    </div>
                                    <div class="bg-white grid grid-cols-2">
                                        <x-list-data label="Staff Medication: " :value="$emergencyContactFields['staff_medication']" wire:model="emergencyContactFields.staff_medication"/>
                                    </div>
                                    <div class="bg-white grid grid-cols-2">
                                        <x-list-data label="Staff Medical Conditions: " :value="$emergencyContactFields['staff_medical_conditions']" wire:model="emergencyContactFields.staff_medical_conditions"/>
                                    </div>
                                    <div class="bg-white grid grid-cols-2">
                                        <x-list-data label="Actions Needed to Medical Conditions: " :value="$emergencyContactFields['actions_needed_to_medical_conditions']" wire:model="emergencyContactFields.actions_needed_to_medical_conditions"/>
                                    </div>
                                    <div class="bg-white grid grid-cols-2">
                                        <x-list-data label="Medical Insurance (Staff): " :value="$emergencyContactFields['staff_medical_insurance']" wire:model="emergencyContactFields.staff_medical_insurance"/>
                                    </div>
                                    <div class="bg-white grid grid-cols-2">
                                        <x-list-data label="Policy Number (Staff): " :value="$emergencyContactFields['staff_policy_number']" wire:model="emergencyContactFields.staff_policy_number"/>
                                    </div>
                                </x-slot>
                        </x-card>
                        <div class="flex">
                            <div class="flex justify-end  w-full">
                                <label class="flex items-center">
                                    <input type="checkbox" class="form-checkbox" name="remember" wire:model.defer="emergencyContactFields.completed" disabled="true">
                                    <span class="ml-2 text-sm text-gray-600">Set as completed</span>
                                </label>
                            </div>
                        </div>
            </div>
        </form> 
</x-staff-layout>
@else 
<x-staff-layout :user="$user" title="Emergency Contact">
    <x-slot name="content">
        <div class="flex mb-4">
            <div class="flex justify-end  w-full">
                <x-jet-button wire:click="enableContactForm" :disabled="$emergencyContactFields['date_of_submission']">
                            <x-heroicon-o-plus class="w-4 h-4" />
                            Create Emergency Contact
                </x-jet-button>
            </div>
        </div>
        <x-flex class="justify-between w-full px-4 py-3">
            @if ( $emergencyContactFields['staff_allergies'])
                <div class="grid grid-cols-1 gap-2">
                    <p class="block font-medium text-sm text-gray-500">
                        <span class="font-semibold text-gray-800">Date submitted:</span>
                        {{ $emergencyContactFields['date_of_submission'] }}
                    </p>
                    <p class="block font-medium text-sm text-gray-500">
                        <span class="font-semibold text-gray-800">Last Modified Date:</span>
                        {{ $emergencyContactFields['modified_date'] }}
                    </p>
                    <p class="block font-medium text-sm text-gray-500">
                        <span class="font-semibold text-gray-800">Status:</span>
                    {{ $emergencyContactFields['status'] }}
                    </p>
                </div>
                <div class="grid grid-cols-1 gap-1">
                        <div>
                            <x-jet-secondary-button wire:click="enableContactForm" class="w-full">
                                <x-heroicon-o-pencil class="w-4 h-4 mr-2 "/>
                                Edit
                            </x-jet-secondary-button>
                        </div>
                        <div>
                            <x-jet-secondary-button wire:click="printPDF" class="w-full">
                                <x-heroicon-o-printer class="w-4 h-4 mr-2"/>
                                Print
                            </x-jet-secondary-button>
                        </div>
                        <div>
                            <x-jet-secondary-button wire:click="$set('viewForm', 1)" class="w-full">
                                <x-heroicon-o-eye class="w-4 h-4 mr-2 "/>
                                View
                            </x-jet-secondary-button>
                        </div>
                        
                </div>
            @else
                <div class="grid grid-cols-1 gap-2">
                    No Emergency Data.
                </div>
            @endif
            
        </x-flex>

    </x-slot>
</x-staff-layout>
@endif