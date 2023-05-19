
<div>
<x-staff-layout :user="$user" title="">
    <x-slot name="header">
        <x-link :href="route('staffs.profile.employee-agreement', $user)">
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
                    <x-card-title> Child Care Employee Data Sheet </x-card-title>
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
                            <x-list-data-input label="Address: ">
                            <x-jet-input
                                id="address"
                                type="text"
                                class="block w-full text-sm md:text-base"
                                wire:model.defer="employee.address"
                                autocomplete="false"
                            />
                        </x-list-data-input>
                    </div>
                    <div class="bg-white grid grid-cols-2">
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data-input label="Phone Number: " >
                                <x-jet-input
                                    id="phone_number"
                                    type="text"
                                    class="block w-full text-sm md:text-base"
                                    wire:model.defer="employee.phone_number"
                                    autocomplete="false"
                                />
                            </x-list-data-input>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data-input label="Date of Birth: " >
                            <x-pikaday
                                    name="dob"
                                    format="MM/DD/YYYY" 
                                    wire:model.lazy="employee.dob"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full text-sm md:text-base"
                                />
                            </x-list-data-input>
                        </div>
                    </div>
                </x-slot>
            </x-card>
        <!-- Employee Education Background Panel-->
            <x-card>
                <x-slot name="header">
                    <x-card-title> Education </x-card-title>
                </x-slot>
                <x-slot name="table">
                @error('error') <span class="error" style="color:red">{{ $message }}</span> @enderror
                    <div class="bg-white grid grid-cols-2">
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data-input label="Name of High School: " >
                                <x-jet-input
                                    id="name_of_high_school"
                                    type="text"
                                    class="block w-full text-sm md:text-base"
                                    wire:model.defer="education.high_school_name"
                                    autocomplete="false"
                                />
                            </x-list-data-input>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data-input label="Grade Completed: " >
                            <x-forms.select
                                    id="title-selector"
                                    label=""
                                    :options="$education['select_options']"
                                    placeholder="Select Grade"
                                    error=""
                                    wire:model.defer="education.grade_completed"
                                />
                            </x-list-data-input>
                        </div>
                    </div>
                    <div class="bg-white grid grid-cols-2">
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data-input label="High School Address: " >
                                <x-jet-input
                                    id="high_school_address"
                                    type="text"
                                    class="block w-full text-sm md:text-base"
                                    wire:model.defer="education.high_school_address"
                                    autocomplete="false"
                                />
                            </x-list-data-input>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data-input label="Graduate Date: " >
                            <x-pikaday
                                    name="graduate_date"
                                    format="MM/DD/YYYY" 
                                    wire:model.lazy="education.graduate_date"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </x-list-data-input>
                        </div>
                    </div>
                    <div class="bg-white grid grid-cols-2">
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data-input label="Name of College: " >
                                <x-jet-input
                                    id="name_of_college"
                                    type="text"
                                    class="block w-full text-sm md:text-base"
                                    wire:model.defer="education.name_of_college"
                                    autocomplete="false"
                                />
                            </x-list-data-input>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data-input label="Semester Hours Completed: " >
                            <x-jet-input
                                    id="semester_hours_completed"
                                    type="text"
                                    class="block w-full text-sm md:text-base"
                                    wire:model.defer="education.semester_hours_completed"
                                    autocomplete="false"
                                />
                            </x-list-data-input>
                        </div>
                    </div>
                    <div class="bg-white grid grid-cols-2">
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data-input label="College Address: " >
                                <x-jet-input
                                    id="college_address"
                                    type="text"
                                    class="block w-full text-sm md:text-base"
                                    wire:model.defer="education.college_address"
                                    autocomplete="false"
                                />
                            </x-list-data-input>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data-input label="Degree Earned: " >
                            <x-jet-input
                                    id="degree_earned"
                                    type="text"
                                    class="block w-full text-sm md:text-base"
                                    wire:model.defer="education.degree_earned"
                                    autocomplete="false"
                                />
                            </x-list-data-input>
                        </div>
                    </div>
                </x-slot>
            </x-card>
        <!-- Employee Employment Experience Panel -->
            <x-card>
                    <x-slot name="header">
                        <x-card-title> Employment Experience </x-card-title>
                    </x-slot>
                    <x-slot name="table">
                
                    @foreach ($employmentExperience as $index => $item)
                        @if ( $index > 0 )
                            </br></br>
                        @endif
                        <div class="bg-white grid grid-cols-2">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Name of Employer: " >
                                    <x-jet-input
                                        id="employer"
                                        type="text"
                                        class="block w-full text-sm md:text-base"
                                        wire:model.defer="employmentExperience.{{$index}}.employer"
                                        wire:key="{{$index}}"
                                    />
                                </x-list-data-input>
                            </div>
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Job Title: " >
                                <x-jet-input
                                    id="job_title"
                                    type="text"
                                    class="block w-full text-sm md:text-base"
                                    wire:model.defer="employmentExperience.{{$index}}.job_title"
                                    wire:key="{{$index}}"
                                />
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-2">
                            <x-list-data-input label="Employer Address: " >
                                <x-jet-input
                                    id="employer_address"
                                    type="text"
                                    class="block w-full text-sm md:text-base"
                                    wire:model.defer="employmentExperience.{{$index}}.employer_address"
                                    wire:key="{{$index}}"
                                />
                            </x-list-data-input>
                        </div>
                        <div class="bg-white grid grid-cols-2">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Employement Start Date: " >
                                <x-pikaday
                                    name="employer_start_date"
                                    format="MM/DD/YYYY" 
                                    wire:model.lazy="employmentExperience.{{$index}}.employment_start_date"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full text-sm md:text-base"
                                    wire:key="{{$index}}"
                                />
                                </x-list-data-input>
                            </div>
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Employment End Date: " >
                                <x-pikaday
                                    name="employment_end_date"
                                    format="MM/DD/YYYY" 
                                    wire:model.lazy="employmentExperience.{{$index}}.employment_end_date"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full text-sm md:text-base"
                                    wire:key="{{$index}}"
                                />
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-2">
                            <x-list-data-input label="Job Description: " >
                                <x-jet-input
                                    id="job_description"
                                    type="text"
                                    class="block w-full text-sm md:text-base"
                                    wire:model.defer="employmentExperience.{{$index}}.job_description"
                                    wire:key="{{$index}}"
                                />
                            </x-list-data-input>
                        </div>
                    @endforeach
                    </x-slot>
            </x-card>
        <!-- Employee Present Position -->
            <x-card>
                    <x-slot name="header">
                        <x-card-title> Present Position </x-card-title>
                    </x-slot>
                    <x-slot name="table">
                    @error('error') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        <div class="bg-white grid grid-cols-2">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Date You Can Start:" >
                                <x-pikaday
                                    name="date_start"
                                    format="MM/DD/YYYY" 
                                    wire:model.lazy="presentPosition.date_start"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full text-sm md:text-base"
                                />
                                </x-list-data-input>
                            </div>
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Days of the Week Available for Work:" >
                                <x-jet-input
                                    id="days_week_available_for_work"
                                    type="text"
                                    class="block w-full text-sm md:text-base"
                                    wire:model.defer="presentPosition.days_week_available_for_work"
                                    autocomplete="false"
                                />
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-2">
                            <x-list-data-input label="Hours of the Day Available for Work:" >
                                <x-jet-input
                                    id="hours_available_for_work"
                                    type="text"
                                    class="block w-full text-sm md:text-base"
                                    wire:model.defer="presentPosition.hours_available_for_work"
                                    autocomplete="false"
                                />
                            </x-list-data-input>
                        </div>
                    </x-slot>
            </x-card>
            <div class="flex">
                <div class="flex justify-end  w-full">
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox" name="remember" wire:model.defer="employee.status">
                        <span class="ml-2 text-sm md:text-base text-gray-600">Submit to Supervisor</span>
                    </label>
                </div>
            </div>
            <x-card-action>
                <div>
                    <x-jet-button wire:click="$set('edited', true)">
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