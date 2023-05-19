<div>
    @if ($view)

    <x-staff-layout :user="$user" title="Employee Data Sheet" >
            <div>
                <x-link :href="route('staffs.profile.employee-agreement', $user)">
                    <x-heroicon-o-arrow-narrow-left class="w-4 h-4 mr-2" />
                    Go Back
                </x-link>
            </div>
            <x-slot name="content">
                <form wire:submit.prevent="test">
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
                                    <x-list-data label="Address: " :value="$employee['address']" wire:model="employee.address"/>
                                </div>
                                <div class="bg-white grid grid-cols-2">
                                    <div class="bg-white grid grid-cols-1">
                                        <x-list-data label="Phone Number: " :value="$employee['phone_number']" wire:model="employee.phone_number"/>
                                    </div>
                                    <div class="bg-white grid grid-cols-1">
                                        <x-list-data label="Date of Birth: " :value="$employee['dob']" wire:model="employee.dob"/>
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
                                <div class="bg-white grid grid-cols-2">
                                    <div class="bg-white grid grid-cols-1">
                                        <x-list-data label="Name of High School: " :value="$education['high_school_name']" wire:model="education.high_school_name"/>
                                    </div>
                                    <div class="bg-white grid grid-cols-1">
                                        <x-list-data label="Grade Completed: " :value="$education['grade_completed']" wire:model="education.grade_completed"/>
                                    </div>
                                </div>
                                <div class="bg-white grid grid-cols-2">
                                    <div class="bg-white grid grid-cols-1">
                                        <x-list-data label="High School Address: " :value="$education['high_school_address']" wire:model="education.high_school_address"/>
                                    </div>
                                    <div class="bg-white grid grid-cols-1">
                                        <x-list-data label="Graduate Date: " :value="$education['graduate_date']" wire:model="education.graduate_date"/>
                                    </div>
                                </div>
                                <div class="bg-white grid grid-cols-2">
                                    <div class="bg-white grid grid-cols-1">
                                        <x-list-data label="Name of College: " :value="$education['name_of_college']" wire:model="education.name_of_college"/>
                                    </div>
                                    <div class="bg-white grid grid-cols-1">
                                        <x-list-data label="Semester Hours Completed: " :value="$education['semester_hours_completed']" wire:model="education.semester_hours_completed"/>
                                    </div>
                                </div>
                                <div class="bg-white grid grid-cols-2">
                                    <div class="bg-white grid grid-cols-1">
                                        <x-list-data label="College Address: " :value="$education['college_address']" wire:model="education.college_address"/>
                                    </div>
                                    <div class="bg-white grid grid-cols-1">
                                        <x-list-data label="Degree Earned: " :value="$education['degree_earned']" wire:model="education.degree_earned"/>
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
                                            <x-list-data label="Name of Employer: " :value="$employmentExperience[$index]['employer']" wire:model="employmentExperience.{{$index}}.employer"/>
                                        </div>
                                        <div class="bg-white grid grid-cols-1">
                                            <x-list-data label="Job Title: " :value="$employmentExperience[$index]['job_title']" wire:model="employmentExperience.{{$index}}.job_title"/>
                                        </div>
                                    </div>
                                    <div class="bg-white grid grid-cols-2">
                                        <x-list-data label="Employer Address: " :value="$employmentExperience[$index]['employer_address']" wire:model="employmentExperience.{{$index}}.employer_address"/>
                                    </div>
                                    <div class="bg-white grid grid-cols-2">
                                        <div class="bg-white grid grid-cols-1">
                                            <x-list-data label="Employement Start Date: " :value="$employmentExperience[$index]['employment_start_date']" wire:model="employmentExperience.{{$index}}.employment_start_date"/>
                                        </div>
                                        <div class="bg-white grid grid-cols-1">
                                            <x-list-data label="Employement End Date: " :value="$employmentExperience[$index]['employment_end_date']" wire:model="employmentExperience.{{$index}}.employment_end_date"/>
                                        </div>
                                    </div>
                                    <div class="bg-white grid grid-cols-2">
                                        <x-list-data label="Job Description: " :value="$employmentExperience[$index]['job_description']" wire:model="employmentExperience.{{$index}}.job_description"/>
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
                                    <div class="bg-white grid grid-cols-2">
                                        <div class="bg-white grid grid-cols-1">
                                            <x-list-data label="Date You Can Start: " :value="$presentPosition['date_start']" wire:model="presentPosition.{{$index}}.date_start"/>
                                        </div>
                                        <div class="bg-white grid grid-cols-1">
                                            <x-list-data label="Days of the Week Available for Work: " :value="$presentPosition['days_week_available_for_work']" wire:model="presentPosition.{{$index}}.days_week_available_for_work"/>
                                        </div>
                                    </div>
                                    <div class="bg-white grid grid-cols-2">
                                        <x-list-data label="Hours of the Day Available for Work: " :value="$presentPosition['hours_available_for_work']" wire:model="presentPosition.{{$index}}.hours_available_for_work"/>
                                    </div>
                                </x-slot>
                        </x-card>
                        <div class="flex">
                            <div class="flex justify-end  w-full">
                                <label class="flex items-center">
                                    <input type="checkbox" class="form-checkbox" name="remember" wire:model.defer="employee.status" disabled="true">
                                    <span class="ml-2 text-sm text-gray-600">Submit to Supervisor</span>
                                </label>
                            </div>
                        </div>
                        <x-card-action>
                        <div>
                            <x-jet-button>
                                Update
                            </x-jet-button>
                        </div>
                    </x-card-action>
                </form>
                </div>
            </x-slot>
    </x-staff-layout>
    @else
    <x-staff-layout :user="$user" title="Employee Agreement">
        <x-slot name="content">
            <div class="eds-content">
                <div class="flex mb-4">
                    <div class="inline w-1/2">
                        <x-jet-section-title>
                            <x-slot name="title">Employee Data Sheet</x-slot>
                            <x-slot name="description"></x-slot>
                        </x-jet-section-title>
                    </div>
                </div>
                <x-card>
                @if($user->hasMedia(slug('Employee Data Sheet'.'-'.$user->id, '_')) && $date_completed)
                    <x-flex class="text-sm md:font-medium justify-between border-b border-gray-200 w-full px-2 lg:px-4 md:px-4 py-3">
                        <div class="grid grid-cols-1 gap-2 w-48 md:w-96 lg:w-96">
                            <p class="block text-sm md:text-base text-gray-500">
                                <span class="text-gray-800">Date Completed:</span>
                                {{ $date_completed }}
                            </p>
                            <p class="block text-sm md:text-base text-gray-500">
                                <span class="text-gray-800">Status</span>
                                {{ 'Submitted & Acknowledged' }}
                            </p>
                        </div>
                        <div class="grid grid-cols-1 gap-1">
                            <div>
                                @if($empAgreementFileExist)
                                <livewire:file-uploader
                                        :user="$user"
                                        :key="uuid()"
                                        :redirect="$employeeAgreementRedirectAfterUpload"
                                        :properties="[
                                            'filename' => 'Employee Data Sheet',
                                            'directory' => 'employee_data_sheet/'.$user->id,
                                            'tag' => slug('Employee Data Sheet'.'-'.$user->id, '_')
                                        ]"
                                        class="btnSameWidth"
                                    />
                                @endif
                                <x-jet-button wire:click="setEmpDataSheetModal" class="btnSameWidth mt-1">
                                    <x-heroicon-o-eye class="text-sm md:text-base w-4 h-4 mr-2"/>
                                    View
                                </x-jet-button>
                            </div>
                            <div>
                                @if($empAgreementFileExist)
                                <x-jet-button wire:click="printEdsPDF" class="btnSameWidth">
                                    <x-heroicon-o-printer class="text-sm md:text-base w-4 h-4 mr-2"/>
                                    Download
                                </x-jet-button>
                                @else
                                    <span class="text-red-500"> ﻿Employee Data Sheet unavailable.</span>
                                @endif
                            </div>
                        </div>
                    </x-flex>
                @else
                <x-flex class="text-sm md:font-medium justify-between border-b border-gray-200 w-full px-2 lg:px-4 md:px-4 py-3">
                        <div class="grid grid-cols-1 gap-2 w-full">
                            <div class="flex justify-between w-full">
                                <div class="flex justify-start">
                                    <p class="block text-sm md:text-base text-gray-500">
                                        <span class="text-gray-800">Date Completed:</span>
                                        @if($date_completed){{ $date_completed }}@endif
                                    </p>
                                </div>
                                <div class="flex justify-end">
                                    <div class="grid grid-cols-1 gap-1">
                                        <div class="flex justify-end">
                                            <livewire:file-uploader
                                                    :user="$user"
                                                    :key="uuid()"
                                                    :redirect="$employeeAgreementRedirectAfterUpload"
                                                    :properties="[
                                                        'filename' => 'Employee Data Sheet',
                                                        'directory' => 'employee_data_sheet/'.$user->id,
                                                        'tag' => slug('Employee Data Sheet'.'-'.$user->id, '_')
                                                    ]"
                                                />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between w-full">
                                <div class="flex justify-start">
                                    <p class="block text-sm md:text-base text-gray-500">
                                        <span class="text-gray-800">Status</span>
                                        {{ 'Incomplete' }}
                                    </p>
                                </div>
                                <div class="flex justify-end">
                                    <div class="grid grid-cols-1 gap-1">
                                        <div class="flex justify-end">
                                        <div>
                                            <x-jet-button wire:click="downloadEmpDataSheet" class="w-full">
                                                <x-heroicon-o-printer class="text-sm md:text-base w-4 h-4 mr-2"/>
                                                Download Data Sheet
                                            </x-jet-button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </x-flex>
                @endif
                </x-card>
            </div>
            <div class="disclosureStatement-content mt-10">
                <x-jet-section-title>
                    <x-slot name="title">Dislosure Statement</x-slot>
                    <x-slot name="description"></x-slot>
                </x-jet-section-title>
                <x-card>
                    <x-flex class="justify-between border-b border-gray-200 w-full px-2 lg:px-4 md:px-4 py-3">
                        <div class="grid grid-cols-1 gap-2">
                            <p class="block text-sm md:text-base text-gray-500">
                                <span class="text-gray-800">Status:</span>
                                {{ $disclosureAgreement['date_signed_disclosure_agreement']? "Disclosure Signed": "Disclosure Not Signed" }}
                            </p>
                            <p class="block text-sm md:text-base text-gray-500">
                                <span class="text-gray-800">Date of Agreement Signed:</span>
                                {{ $disclosureAgreement['date_signed_disclosure_agreement'] }}
                            </p>
                        </div>
                        <div class="grid grid-cols-1 gap-1">

                           @if ($disclosureAgreement['date_signed_disclosure_agreement'])
                           <div>
                                @if($disclosureFileExist)
                                 <x-jet-secondary-button wire:click="$set('viewModalDislosureAgreement', 'true')" class="w-full">
                                    <x-heroicon-o-eye class="w-4 h-4 mr-2 "/>
                                    View
                                </x-jet-secondary-button>
                                @endif
                            </div>
                           <div>
                                @if($disclosureFileExist)
                                <x-jet-secondary-button wire:click="downloadDisclosureAgreement" class="w-full">
                                    <x-heroicon-o-download class="w-4 h-4 mr-2"/>
                                    Download
                                </x-jet-secondary-button>
                                @else
                                <span class="text-red-500">Disclosure Statement unavailable.</span>
                                @endif
                            </div>
                           @else
                           <div>
                                <x-jet-secondary-button wire:click="$set('displayModalDislosureAgreement', 'true')" class="w-full">
                                    <x-heroicon-o-clipboard-check class="w-4 h-4 mr-2 "/>
                                    Sign
                                </x-jet-secondary-button>
                            </div>
                           @endif
                        </div>
                    </x-flex>
                </x-card>
                <!-- Sign Disclusore Agreement Modal -->
                <div>
                <x-jet-dialog-modal :id="'sign-disclosure-statement'" wire:model="displayModalDislosureAgreement" >
                        <x-slot name="title">
                           <div class="text-center text-sm md:text-base"> Disclosure Statement </div>
                        </x-slot>

                        <x-slot name="content">
                            <embed src= "{{ $staffDisclosureAgreementTempUrl }}" class="overflow-y-scroll md:h-96 w-full"/>

                            <div class="text-center mt-8 font-bold text-sm">
                            @if ( !$disclosureAgreement['date_signed_disclosure_agreement'] )
                                <input type="checkbox" class="form-checkbox" wire:click="disclosureAgreement" wire:model="disclosureAgreementChecker"> By agreeing to this statement you are electronically consenting to this agreement. Do you accept the terms of this disclosure statement of employment?
                            @endif
                            </div>
                        </x-slot>

                        <x-slot name="footer">
                            <x-jet-danger-button wire:click="$set('displayModalDislosureAgreement', false)">
                                Reject
                            </x-jet-danger-button>

                            @if ( !$showAcceptBtnForDisclosureAgreement )
                                <x-jet-secondary-button class="ml-2 bg-gray-50 border-gray-50" wire:click="acceptDisclosureAgreement" disabled>
                                    <span class="text-sm md:text-base text-gray-200">Accept</span>
                                </x-jet-secondary-button>
                            @else
                                <x-jet-secondary-button class="ml-2" wire:click="acceptDisclosureAgreement">
                                    Accept
                                </x-jet-secondary-button>
                            @endif
                        </x-slot>
                </x-jet-dialog-modal>
                </div>
                <!-- View Disclusore Agreement Modal -->
                <div>
                <x-jet-dialog-modal :id="'view-disclosure-statement'" wire:model="viewModalDislosureAgreement" class="h-100 w-full">
                        <x-slot name="title">
                           <div class="text-center text-sm md:text-base"> Disclosure Statement </div>
                        </x-slot>

                        <x-slot name="content">
                            <embed src= "{{ $staffDisclosureAgreementTempUrl }}" class="overflow-y-scroll md:h-96 w-full"/>
                        </x-slot>

                        <x-slot name="footer">
                            <x-jet-danger-button wire:click="$set('viewModalDislosureAgreement', false)" wire:loading.attr="disabled">
                                Ok
                            </x-jet-danger-button>
                        </x-slot>
                </x-jet-dialog-modal>
                </div>
            </div>
            <div class="staffHandbook-content mt-10">
                <x-jet-section-title>
                    <x-slot name="title">Staff Handbook</x-slot>
                    <x-slot name="description"></x-slot>
                </x-jet-section-title>
                <x-card>
                    <x-flex class="justify-between border-b border-gray-200 w-full px-2 lg:px-4 md:px-4 py-3">
                        <div class="grid grid-cols-1 gap-2">
                            <p class="block text-sm md:text-base text-gray-500">
                                <span class="text-gray-800">Status:</span>
                                {{ $handbookAgreement['date_signed_disclosure_agreement']? "Handbook Signed": "Handbook Not Signed" }}
                            </p>
                            <p class="block text-sm md:text-base text-gray-500">
                                <span class="text-gray-800">Date of Agreement Signed:</span>
                                {{ $handbookAgreement['date_signed_disclosure_agreement'] }}
                            </p>
                        </div>
                        <div class="grid grid-cols-1 gap-1">
                           @if ($handbookAgreement['date_signed_disclosure_agreement'])
                           <div>
                                @if($handbookFileExist)
                                <x-jet-secondary-button wire:click="viewHandbooModal" class="w-full">
                                    <x-heroicon-o-eye class="w-4 h-4 mr-2 text-sm md:text-base"/>
                                    View
                                </x-jet-secondary-button>
                                @endif
                            </div>
                           <div>
                                @if($handbookFileExist)
                                <x-jet-secondary-button wire:click="downloadHandbookAgreement" class="w-full">
                                    <x-heroicon-o-download class="w-4 h-4 mr-2 text-sm md:text-base"/>
                                    Download
                                </x-jet-secondary-button>
                                @else
                                <span class="text-red-500">Handbook Agreement File Unavailable.</span>
                                @endif
                            </div>
                           @else
                           <div>
                                @if($handbookFileExist)
                                <x-jet-secondary-button wire:click="$set('displayModalHandbookAgreement', 'true')" class="w-full">
                                    <x-heroicon-o-clipboard-check class="w-4 h-4 mr-2 text-sm md:text-base"/>
                                    Sign
                                </x-jet-secondary-button>
                                @else
                                <span class="text-red-500">Handbook Agreement File Unavailable.</span>
                                @endif
                            </div>
                           @endif
                        </div>
                    </x-flex>
                </x-card>
                <!-- View Handbook Agreement Modal -->
                <div>
                <x-jet-dialog-modal :id="'view-handbook-statement'" wire:model="displayModalHandbookAgreement">
                        <x-slot name="title">
                        <div class="text-center text-sm md:text-base"> Staff Handbook </div>
                           <div class="text-center text-sm md:text-base">of Policies and Procedures</div>
                        </x-slot>

                        <x-slot name="content">
                           <div>
                                <embed src= "{{ $staffHandbookTempUrl }}" class="overflow-y-scroll md:h-96 w-full"/>
                                <div class="text-center font-bold mt-8 text-sm">
                                    @if ( !$handbookAgreement['date_signed_disclosure_agreement'] )
                                        <input type="checkbox" class="form-checkbox" wire:click="staffAgreement" wire:model="staffAgreementChecker" wire:click="$set('showAcceptBtnForHandbook', true)">By agreeing to this statement you are electronically consenting to this agreement. Do you accept the terms of this disclosure statement of employment?
                                    @endif
                                </div>
                           </div>
                        </x-slot>
                        <div>
                        @if ( !$viewModalHandbookAgreement )
                        <x-slot name="footer">
                            <x-jet-danger-button wire:click="$set('displayModalHandbookAgreement', false)" wire:loading.attr="disabled">
                                Reject
                            </x-jet-danger-button>

                            @if ( !$showAcceptBtnForHandbook )
                                <x-jet-secondary-button class="ml-2 bg-gray-50 border-gray-50" wire:click="acceptHandbookAgreement" disabled>
                                    <span class="text-gray-200 text-sm md:text-base">Accept</span>
                                </x-jet-secondary-button>
                            @else
                                <x-jet-secondary-button class="ml-2 text-sm md:text-base" wire:click="acceptHandbookAgreement" >
                                    Accept
                                </x-jet-secondary-button>
                            @endif
                        </x-slot>
                        @else
                        <x-slot name="footer">
                            <x-jet-danger-button wire:click="closeModalHandbook">
                                Ok
                            </x-jet-danger-button>
                        </x-slot>
                        @endif
                        </div>
                </x-jet-dialog-modal>
                </div>
            </div>
        </x-slot>
    </x-staff-layout>
    @endif
    @include('livewire.users.staffs.profile.view-modal')
    </div>
